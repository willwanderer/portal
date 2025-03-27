/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

describe('Text Inline Popup plugin', () => {
	describe('Image', () => {
		describe('Click on the image', () => {
			it('Should Open inline popup', () => {
				const editor = getJodit();

				editor.value = '<img alt="" src="tests/artio.jpg"/>';
				editor.s.focus();

				simulateEvent('click', editor.editor.querySelector('img'));

				const popup = getOpenedPopup(editor);

				expect(popup && popup.parentNode.parentNode != null).equals(
					true
				);
			});

			describe('and click in opened popup on pencil button', () => {
				it('Should Open edit image dialog', () => {
					const editor = getJodit();

					editor.value = '<img alt="" src="tests/artio.jpg"/>';
					editor.s.focus();

					simulateEvent('click', editor.editor.querySelector('img'));

					const popup = getOpenedPopup(editor);

					expect(popup && popup.parentNode.parentNode != null).is
						.true;

					clickButton('pencil', popup);

					const dialog = editor.ownerDocument.querySelector(
						'.jodit.jodit-dialog[data-editor_id=' + editor.id + ']'
					);

					expect(dialog).is.not.null;
				});
			});
		});
	});

	describe('Link', () => {
		describe('Click on the link', () => {
			it('Should Open inline popup', () => {
				const editor = getJodit();

				editor.value = '<a href="../artio.jpg"/>test</a>';

				simulateEvent('click', editor.editor.querySelector('a'));

				const popup = getOpenedPopup(editor);

				expect(popup && popup.parentNode.parentNode != null).equals(
					true
				);
			});

			describe('and click in opened popup on pencil button', () => {
				it('Should Open edit link dialog', () => {
					const editor = getJodit();

					editor.value = '<a href="../artio.jpg"/>test</a>';
					simulateEvent('click', editor.editor.querySelector('a'));

					const popup = getOpenedPopup(editor);

					expect(popup && popup.parentNode.parentNode != null).is
						.true;

					clickButton('link', popup);

					const linkEditor = getOpenedPopup(editor);

					expect(linkEditor).is.not.null;

					expect(
						linkEditor.querySelector('[data-ref="url_input"]').value
					).equals('../artio.jpg');
				});

				describe('on different links', () => {
					it('Should Open edit link dialog with different values', () => {
						const editor = getJodit();

						editor.value =
							'<a href="#test1"/>test</a><br>' +
							'<a href="#test2"/>test</a>';

						simulateEvent(
							'click',
							editor.editor.querySelector('a')
						);

						const popup = getOpenedPopup(editor);

						clickButton('link', popup);

						const linkEditor = getOpenedPopup(editor);

						expect(
							linkEditor.querySelector('[data-ref="url_input"]')
								.value
						).equals('#test1');

						simulateEvent(
							['mousedown', 'mouseup', 'click'],
							editor.editor.querySelectorAll('a')[1]
						);

						const popup2 = getOpenedPopup(editor);

						clickButton('link', popup2);

						const linkEditor2 = getOpenedPopup(editor);

						expect(
							linkEditor2.querySelector('[data-ref="url_input"]')
								.value
						).equals('#test2');
					});
				});
			});
		});
	});

	describe('Table', () => {
		describe('Table button', () => {
			describe('Select table cell', () => {
				it('Should Select table cell', () => {
					const editor = getJodit();

					editor.value =
						'<table>' + '<tr><td>2</td></tr>' + '</table>';

					const td = editor.editor.querySelector('td'),
						pos = Jodit.modules.Helpers.position(td);

					simulateEvent(
						['mousedown', 'mouseup', 'click'],
						0,
						td,
						e => {
							Object.assign(e, {
								clientX: pos.left,
								clientY: pos.top
							});
						}
					);

					expect([td]).deep.equals(
						editor.getInstance('Table').getAllSelectedCells()
					);
				});

				describe('and press brush button', () => {
					it('Should Select table cell and fill it in yellow', () => {
						const editor = getJodit();

						editor.value =
							'<table>' + '<tr><td>3</td></tr>' + '</table>';

						const td = editor.editor.querySelector('td'),
							pos = Jodit.modules.Helpers.position(td);

						simulateEvent(
							['mousedown', 'mouseup', 'click'],
							td,
							e => {
								Object.assign(e, {
									clientX: pos.left,
									clientY: pos.top
								});
							}
						);

						const popup = getOpenedPopup(editor);

						expect(popup && popup.parentNode.parentNode != null).is
							.true;

						clickButton('brushCell', popup);

						const popupColor = getOpenedPopup(editor);

						expect(
							popupColor &&
								window.getComputedStyle(popupColor).display
						).equals('block');

						simulateEvent(
							['mousedown', 'mouseup', 'click'],
							popupColor.querySelector('[data-color="#0000FF"]')
						);

						expect(
							Jodit.modules.Helpers.normalizeColor(
								td.style.backgroundColor
							)
						).equals('#0000FF');

						expect(popupColor.parentNode).is.null;
					});
				});
			});
		});

		it('Open inline popup after click inside the cell', () => {
			const editor = getJodit();

			editor.value = '<table><tbody><tr><td>1</td></tr></tbody></table>';

			const td = editor.editor.querySelector('td'),
				pos = Jodit.modules.Helpers.position(td);

			simulateEvent('focus', editor.editor);
			simulateEvent(
				['mousedown', 'selectstart', 'mouseup', 'click'],
				td,
				e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				}
			);

			const popup = getOpenedPopup(editor);
			expect(popup).is.not.null;
		});

		describe('Select table cell', () => {
			it('Select table cell and change it vertical align', () => {
				const editor = getJodit();

				editor.value =
					'<table>' +
					'<tr><td style="vertical-align: middle">3</td></tr>' +
					'</table>';

				const td = editor.editor.querySelector('td');
				const pos = Jodit.modules.Helpers.position(td);

				simulateEvent(['mousedown', 'mouseup', 'click'], td, e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				});

				const popup = getOpenedPopup(editor);
				expect(popup && popup.parentNode.parentNode != null).is.true;

				clickTrigger('valign', popup);

				const popupColor = getOpenedPopup(editor);
				expect(popupColor).is.not.null;

				clickButton('Bottom', popupColor);

				expect(td.style.verticalAlign).equals('bottom');
			});

			it('Select table cell and split it by vertical', () => {
				const editor = getJodit();

				editor.value =
					'<table style="width: 300px;">' +
					'<tr><td>3</td></tr>' +
					'</table>';

				const td = editor.editor.querySelector('td'),
					pos = Jodit.modules.Helpers.position(td);

				simulateEvent(['mousedown', 'mouseup', 'click'], td, e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				});
				const popup = getOpenedPopup(editor);
				clickTrigger('splitv', popup);

				const list = getOpenedPopup(editor);
				expect(list).is.not.null;
				clickButton('tablesplitv', list);

				expect(sortAttributes(editor.value)).equals(
					'<table style="width:300px"><tbody><tr><td style="width:49.83%">3</td><td style="width:49.83%"><br></td></tr></tbody></table>'
				);
			});

			it('Select table cell and split it by horizontal', () => {
				const editor = getJodit();

				editor.value =
					'<table style="width: 300px;">' +
					'<tr><td>5</td></tr>' +
					'</table>';

				const td = editor.editor.querySelector('td'),
					pos = Jodit.modules.Helpers.position(td);

				simulateEvent(['mousedown', 'mouseup', 'click'], 0, td, e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				});

				const popup = getOpenedPopup(editor);

				clickTrigger('splitv', popup);
				const list = getOpenedPopup(editor);
				expect(list).is.not.null;
				clickButton('tablesplitg', list);

				expect(sortAttributes(editor.value)).equals(
					'<table style="width:300px"><tbody><tr><td>5</td></tr><tr><td><br></td></tr></tbody></table>'
				);
			});

			it('Select two table cells and merge then in one', () => {
				const editor = getJodit();

				editor.value =
					'<table style="width: 300px;">' +
					'<tr><td>5</td><td>6</td></tr>' +
					'</table>';

				const td = editor.editor.querySelector('td'),
					next = editor.editor.querySelectorAll('td')[1];

				simulateEvent('mousedown', td);

				simulateEvent(['mousemove', 'mouseup'], next);

				const popup = getOpenedPopup(editor);

				clickButton('merge', popup);

				expect(sortAttributes(editor.value)).equals(
					'<table style="width:300px"><tbody><tr><td>5<br>6</td></tr></tbody></table>'
				);
			});

			describe('Add', () => {
				let editor, popup;

				beforeEach(() => {
					editor = getJodit();

					editor.value =
						'<table>' + '<tr><td>3</td></tr>' + '</table>';

					const td = editor.editor.querySelector('td'),
						pos = Jodit.modules.Helpers.position(td);

					simulateEvent(['mousedown', 'mouseup', 'click'], td, e => {
						Object.assign(e, {
							clientX: pos.left,
							clientY: pos.top
						});
					});

					popup = getOpenedPopup(editor);

					expect(popup && popup.parentNode.parentNode != null).is
						.true;
				});

				describe('Click on icon', () => {
					describe('Add column', () => {
						it('Should just open popup', () => {
							clickButton('addcolumn', popup);

							const popupColor = getOpenedPopup(editor);
							expect(popupColor).does.not.eq(popup);
						});
					});

					describe('Add row', () => {
						it('Should just open popup', () => {
							clickButton('addrow', popup);

							const popupColor = getOpenedPopup(editor);
							expect(popupColor).does.not.eq(popup);
						});
					});
				});

				describe('column before', () => {
					it('Should add column before this', () => {
						clickTrigger('addcolumn', popup);

						const popupColor = getOpenedPopup(editor);

						clickButton('Insert column before', popupColor);

						expect(sortAttributes(editor.value)).equals(
							'<table><tbody><tr><td></td><td>3</td></tr></tbody></table>'
						);
					});
				});

				describe('row above', () => {
					it('Should add row above this', () => {
						clickTrigger('addrow', popup);

						const popupColor = getOpenedPopup(editor);

						clickButton('Insert row above', popupColor);

						expect(sortAttributes(editor.value)).equals(
							'<table><tbody><tr><td></td></tr><tr><td>3</td></tr></tbody></table>'
						);
					});
				});
			});

			describe('Remove', () => {
				let editor = null,
					popup;
				beforeEach(() => {
					editor = getJodit();

					editor.value =
						'<table>' +
						'<tr><td>1</td><td>4</td></tr>' +
						'<tr><td>2</td><td>5</td></tr>' +
						'<tr><td>3</td><td>6</td></tr>' +
						'</table>';

					const td = editor.editor.querySelectorAll('td')[1],
						pos = Jodit.modules.Helpers.position(td);

					simulateEvent(['mousedown', 'mouseup', 'click'], td, e => {
						Object.assign(e, {
							clientX: pos.left,
							clientY: pos.top
						});
					});

					popup = getOpenedPopup(editor);

					expect(popup && popup.parentNode.parentNode != null).is
						.true;
				});

				describe('Row', () => {
					it('should remove it row', () => {
						clickTrigger('delete', popup);

						const popupColor = getOpenedPopup(editor);
						expect(
							popupColor &&
								window.getComputedStyle(popupColor).display
						).equals('block');

						clickButton('Delete row', popupColor);

						expect(editor.value).equals(
							'<table><tbody><tr><td>2</td><td>5</td></tr><tr><td>3</td><td>6</td></tr></tbody></table>'
						);
					});
				});

				describe('Column', () => {
					it('should remove whole table', () => {
						clickTrigger('delete', popup);

						const popupColor = getOpenedPopup(editor);

						clickButton('Delete column', popupColor);

						expect(editor.value).equals(
							'<table><tbody><tr><td>1</td></tr><tr><td>2</td></tr><tr><td>3</td></tr></tbody></table>'
						);
					});
				});

				describe('Table', () => {
					it('should remove whole table', () => {
						clickTrigger('delete', popup);

						const popupColor = getOpenedPopup(editor);

						clickButton('Delete table', popupColor);

						expect(editor.value).equals('');
					});
				});

				describe('Click on the trash button', () => {
					it('should just open trigger', () => {
						clickButton('delete', popup);

						const popupColor = getOpenedPopup(editor);
						expect(popupColor).does.not.eq(popup);
					});
				});
			});

			it('Select table cell and remove whole table should hide inline popup', () => {
				const editor = getJodit();

				editor.value =
					'<table>' +
					'<tr><td>1</td></tr>' +
					'<tr><td>2</td></tr>' +
					'<tr><td>3</td></tr>' +
					'</table>';

				const td = editor.editor.querySelectorAll('td')[1];

				const pos = Jodit.modules.Helpers.position(td);

				simulateEvent(['mousedown', 'mouseup', 'click'], 0, td, e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				});

				const popup = getOpenedPopup(editor);

				expect(popup && popup.parentNode.parentNode != null).is.true;

				clickTrigger('delete', popup);

				const popupColor = getOpenedPopup(editor);
				expect(
					popupColor && window.getComputedStyle(popupColor).display
				).equals('block');

				simulateEvent('click', 0, popupColor.querySelector('button'));

				expect(editor.value).equals('');

				expect(popup && popup.parentNode).is.null;
			});
		});

		describe('Starting to change text', () => {
			it('Should hide inline popup', () => {
				const editor = getJodit();

				editor.value = '<table><tr><td>1</td></tr></table>';

				const td = editor.editor.querySelector('td'),
					pos = Jodit.modules.Helpers.position(td);

				simulateEvent(['mousedown', 'mouseup', 'click'], td, e => {
					Object.assign(e, {
						clientX: pos.left,
						clientY: pos.top
					});
				});

				const popup = getOpenedPopup(editor);

				expect(popup && popup.parentNode.parentNode != null).is.true;

				editor.e.fire('change');
				editor.e.fire('change');

				expect(popup && popup.parentNode).is.null;
			});
		});

		describe('Select text inside table cell', () => {
			it('Should show popup for text selection', () => {
				const editor = getJodit({
					toolbarInlineForSelection: true
				});

				editor.value =
					'<table>' +
					'<tr><td>text |inside| cell</td></tr>' +
					'</table>';

				const td = editor.editor.querySelector('td');

				simulateEvent(['mousedown'], td);
				setCursorToChar(editor);
				simulateEvent(['mouseup', 'selectionchange'], td);

				const popup = getOpenedPopup(editor);
				expect(popup && popup.parentNode.parentNode != null).is.true;
				expect(getButton('bold', popup)).is.not.null;
			});
		});

		describe('Link inside cell', () => {
			describe('Click on the link', () => {
				it('Should Open inline popup', () => {
					const editor = getJodit();

					editor.value =
						'<table style="width: 100%;">' +
						'<tbody>' +
						'<tr>' +
						'<td><a href="http://localhost:8000/">href</a></td>' +
						'<td><br></td>' +
						'</tr>' +
						'</tbody>' +
						'</table>';

					simulateEvent('click', editor.editor.querySelector('a'));

					simulateEvent(
						'mousedown',
						editor.editor.querySelector('a')
					);
					simulateEvent('mouseup', editor.editor.querySelector('a'));
					simulateEvent('click', editor.editor.querySelector('a'));

					const popup = getOpenedPopup(editor);

					expect(popup && popup.parentNode.parentNode != null).equals(
						true
					);

					clickButton('link', popup);

					const linkEditor = getOpenedPopup(editor);

					expect(linkEditor).is.not.null;

					const input = linkEditor.querySelector(
						'[data-ref="url_input"]'
					);

					expect(input.value).equals('http://localhost:8000/');

					simulateEvent('mousedown', input);
					simulateEvent('mouseup', input);
					simulateEvent('click', input);

					input.focus();

					expect(popup && popup.parentNode.parentNode != null).equals(
						true
					);

					linkEditor.querySelector('[data-ref="url_input"]').value =
						'https://xdsoft.net';
				});
			});
		});
	});

	describe('when a string is passed to the popup config', () => {
		it('Should show the content of the string in the popup', () => {
			it('Should Open inline popup', () => {
				const editor = getJodit({
					popup: {
						a: '<div class="custom-popup-test">foo</div>'
					}
				});

				editor.value = '<a href="../artio.jpg"/>test</a>';

				simulateEvent('click', editor.editor.querySelector('a'));

				const popup = getOpenedPopup(editor);

				expect(
					popup.getElementsByClassName('.custom-popup-test').length
				).equals(1);
			});
		});
	});
});
