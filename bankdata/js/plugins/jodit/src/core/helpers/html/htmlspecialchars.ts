/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

/**
 * @module helpers/html
 */

import { globalDocument } from 'jodit/core/constants';

/**
 * Convert special characters to HTML entities
 */
export function htmlspecialchars(html: string): string {
	const tmp = globalDocument.createElement('div');
	tmp.textContent = html;
	return tmp.innerHTML;
}
