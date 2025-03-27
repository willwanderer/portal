/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

/**
 * @module helpers/utils
 */

import type { IDictionary } from 'jodit/types';
import { isArray } from 'jodit/core/helpers/checker/is-array';
import { isPlainObject } from 'jodit/core/helpers/checker/is-plain-object';
import { isString } from 'jodit/core/helpers/checker/is-string';
import { isVoid } from 'jodit/core/helpers/checker/is-void';
import { Config } from 'jodit/config';

import { isAtom } from './extend';
import { keys } from './utils';

/**
 * @example
 * ```js
 * const defaultConfig = {
 *   a: {
 *     b: {
 *       c: 2
 *     },
 *     e: 5
 *   },
 *   d: {
 *     g: 7
 *   }
 * };
 *
 * const options = ConfigProto({a: {
 *   b: {
 *     c: 1
 *   }
 * }}, defaultConfig);
 *
 * console.log(options.a.b.c); // 1
 * console.log(options.a.e); // 5
 * console.log(options.d.g); // 7
 *
 * defaultConfig.d.g  = 8;
 * console.log(options.d.g); // 8
 *
 * ```
 */
export function ConfigProto(
	options: IDictionary,
	proto: IDictionary,
	deep: number = 0
): IDictionary {
	// Already prototyped object should not be prototyped again
	if (Object.getPrototypeOf(options) !== Object.prototype) {
		return options;
	}

	const def = Config.defaultOptions;

	if (isString(options.preset)) {
		if (def.presets[options.preset] !== undefined) {
			const preset = def.presets[options.preset];

			Object.keys(preset).forEach(subKey => {
				if (isVoid(options[subKey])) {
					options[subKey] = preset[subKey];
				}
			});
		}

		delete options.preset;
	}

	const newOpt: IDictionary = {};

	Object.keys(options).forEach(key => {
		const opt = options[key],
			protoKey = proto ? proto[key] : null;

		if (isPlainObject(opt) && isPlainObject(protoKey) && !isAtom(opt)) {
			newOpt[key] = ConfigProto(opt, protoKey, deep + 1);
			return;
		}

		// On the first level all arrays are atomic
		if (deep !== 0 && isArray(opt) && !isAtom(opt) && isArray(protoKey)) {
			newOpt[key] = [...opt, ...protoKey.slice(opt.length)];
			return;
		}

		newOpt[key] = opt;
	});

	Object.setPrototypeOf(newOpt, proto);

	return newOpt;
}

export function ConfigFlatten(obj: IDictionary): IDictionary {
	return keys(obj, false).reduce((app, key) => {
		app[key] = obj[key];
		return app;
	}, {} as IDictionary);
}

/**
 * Returns a plain object from a prototype-based object.
 * ```typescript
 * const editor = Jodit.make('#editor', {
 *   image: {
 *     dialogWidth: 500
 *   }
 * });
 *
 * console.log(editor.o.image.openOnDblClick) // true
 * // But you can't get all options in plain object
 * console.log(JSON.stringify(editor.o.image)); // {"dialogWidth":500}
 *
 * const plain = Jodit.modules.Helpers.ConfigDeepFlatten(editor.o.image);
 * console.log(JSON.stringify(plain)); // {"dialogWidth":500, "openOnDblClick": true, "editSrc": true, ...}
 * ```
 */
export function ConfigDeepFlatten(obj: IDictionary): IDictionary {
	return keys(obj, false).reduce((app, key) => {
		app[key] = isPlainObject(obj[key])
			? ConfigDeepFlatten(obj[key])
			: obj[key];
		return app;
	}, {} as IDictionary);
}
