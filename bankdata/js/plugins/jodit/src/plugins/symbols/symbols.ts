/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

/**
 * [[include:plugins/symbols/README.md]]
 * @packageDocumentation
 * @module plugins/symbols
 */

import type { IJodit } from 'jodit/types';
import {
	KEY_DOWN,
	KEY_ENTER,
	KEY_LEFT,
	KEY_RIGHT,
	KEY_UP
} from 'jodit/core/constants';
import { Dom } from 'jodit/core/dom/dom';
import { extendLang, pluginSystem } from 'jodit/core/global';
import { attr } from 'jodit/core/helpers/utils';
import { Plugin } from 'jodit/core/plugin/plugin';

import './config';

import * as langs from './langs';

import './symbols.less';

/**
 * The plugin inserts characters that are not part of the standard keyboard.
 */
export class symbols extends Plugin {
	override buttons: Plugin['buttons'] = [
		{
			name: 'symbols',
			group: 'insert'
		}
	];

	private __countInRow: number = 17;

	constructor(jodit: IJodit) {
		super(jodit);
		extendLang(langs);
	}

	override afterInit(jodit: IJodit): void {
		jodit.e.on('generateSpecialCharactersTable.symbols', () => {
			const container = jodit.c.fromHTML(
				`<div class="jodit-symbols__container">
						<div class="jodit-symbols__container_table">
							<table class="jodit-symbols__table"><tbody></tbody></table>
						</div>
						<div class="jodit-symbols__container_preview">
							<div class="jodit-symbols__preview"></div>
						</div>
					</div>`
			) as HTMLDivElement;

			const preview = container.querySelector(
				'.jodit-symbols__preview'
			) as HTMLDivElement;

			const table = container.querySelector('table') as HTMLTableElement;
			const body: HTMLTableSectionElement = table.tBodies[0];
			const chars: HTMLAnchorElement[] = [];

			for (let i: number = 0; i < jodit.o.specialCharacters.length; ) {
				const tr = jodit.c.element('tr');

				for (
					let j = 0;
					j < this.__countInRow &&
					i < jodit.o.specialCharacters.length;
					j += 1, i += 1
				) {
					const td = jodit.c.element('td'),
						a = jodit.c.fromHTML(
							`<a
									data-index="${i}"
									data-index-j="${j}"
									role="option"
									tabindex="-1"
							>${jodit.o.specialCharacters[i]}</a>`
						) as HTMLAnchorElement;

					chars.push(a);
					td.appendChild(a);
					tr.appendChild(td);
				}

				body.appendChild(tr);
			}

			const self: symbols = this;

			jodit.e
				.on(chars, 'focus', function (this: HTMLAnchorElement) {
					preview.innerHTML = this.innerHTML;
				})
				.on(
					chars,
					'mousedown',
					function (this: HTMLAnchorElement, e?: MouseEvent) {
						if (Dom.isTag(this, 'a')) {
							jodit.s.focus();
							jodit.s.insertHTML(this.innerHTML);
							if (!e?.shiftKey) {
								jodit.e.fire(this, 'close_dialog');
							}
							e && e.preventDefault();
							e && e.stopImmediatePropagation();
						}
					}
				)
				.on(chars, 'mouseenter', function (this: HTMLAnchorElement) {
					if (Dom.isTag(this, 'a')) {
						this.focus();
					}
				})
				.on(chars, 'keydown', (e: KeyboardEvent) => {
					const target = e.target;

					if (Dom.isTag(target, 'a')) {
						const index = parseInt(
								attr(target, '-index') || '0',
								10
							),
							jIndex = parseInt(
								attr(target, 'data-index-j') || '0',
								10
							);

						let newIndex: number;

						switch (e.key) {
							case KEY_UP:
							case KEY_DOWN:
								newIndex =
									e.key === KEY_UP
										? index - self.__countInRow
										: index + self.__countInRow;

								if (chars[newIndex] === undefined) {
									newIndex =
										e.key === KEY_UP
											? Math.floor(
													chars.length /
														self.__countInRow
												) *
													self.__countInRow +
												jIndex
											: jIndex;

									if (newIndex > chars.length - 1) {
										newIndex -= self.__countInRow;
									}
								}

								chars[newIndex] && chars[newIndex].focus();
								break;

							case KEY_RIGHT:
							case KEY_LEFT:
								newIndex =
									e.key === KEY_LEFT ? index - 1 : index + 1;
								if (chars[newIndex] === undefined) {
									newIndex =
										e.key === KEY_LEFT
											? chars.length - 1
											: 0;
								}

								chars[newIndex] && chars[newIndex].focus();
								break;

							case KEY_ENTER:
								jodit.e.fire(target, 'mousedown');
								e.stopImmediatePropagation();
								e.preventDefault();
								break;
						}
					}
				});

			return container;
		});
	}

	/** @override */
	protected beforeDestruct(jodit: IJodit): void {
		jodit.e.off('generateSpecialCharactersTable.symbols');
	}
}

pluginSystem.add('symbols', symbols);