/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

describe('Undo/Redo behaviors', () => {
	describe('Do some changes', () => {
		it('Should change redo/undo stack', () => {
			const editor = getJodit({
				history: {
					timeout: 0
				}
			});

			editor.value = 'test';

			const range = editor.s.createRange();
			range.setEnd(editor.editor.firstChild.firstChild, 4);
			range.collapse(false);
			editor.s.selectRange(range);

			clickTrigger('paragraph', editor);

			const list = getOpenedPopup(editor);

			clickButton('h1', list);

			expect(editor.value).equals('<h1>test</h1>');

			editor.execCommand('undo');

			expect(editor.value).equals('<p>test</p>');

			editor.execCommand('redo');

			expect(editor.value).equals('<h1>test</h1>');
		});

		describe('Several operations', () => {
			it('Should work perfect', () => {
				const editor = getJodit();
				editor.value =
					'<p>t|est</p>' +
					'<ul>' +
					'<li>test2|</li>' +
					'<li>test3</li>' +
					'<li><a>test4</a></li>' +
					'</ul>';

				setCursorToChar(editor);

				simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);

				expect(editor.value).equals(
					'<p>t</p><ul><li>test3</li><li><a>test4</a></li></ul>'
				);

				editor.execCommand('undo');

				expect(editor.value).equals(
					'<p>test</p><ul><li>test2</li><li>test3</li><li><a>test4</a></li></ul>'
				);

				const range = editor.s.createRange();
				range.setStart(editor.editor.firstChild.firstChild, 0);
				range.setEnd(editor.editor.firstChild.firstChild, 3);
				editor.s.selectRange(range);

				simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);

				expect(editor.value).equals(
					'<p>t</p><ul><li>test2</li><li>test3</li><li><a>test4</a></li></ul>'
				);

				editor.execCommand('undo');

				expect(editor.value).equals(
					'<p>test</p><ul><li>test2</li><li>test3</li><li><a>test4</a></li></ul>'
				);
			});

			describe('Several changes from autside with editor.value', () => {
				it('Should change redo/undo stack immediately', () => {
					const editor = getJodit();

					editor.value = '<p>test1<p>';
					expect(editor.history.length).eq(1);
					editor.value = '<p>test2<p>';
					expect(editor.history.length).eq(2);
					editor.value = '<p>test3<p>';
					expect(editor.history.length).eq(3);
					editor.value = '<p>test3<p>';
					expect(editor.history.length).eq(3);
				});
			});
		});
	});

	describe('Commands', () => {
		it('Undo. Enter text wait and again enter text. After execute "undo" command. First text should be returned', () => {
			const editor = getJodit({
				history: {
					timeout: 0 // disable delay
				}
			});

			editor.value = 'test';
			editor.value = 'test2';
			editor.execCommand('undo');
			expect(editor.value).equals('<p>test</p>');
		});

		it('Redo. Enter text wait and again enter text. After execute "undo" + "redo" command in editor should be second text', () => {
			const editor = getJodit({
				history: {
					timeout: 0
				}
			});

			editor.value = 'test';
			editor.value = 'test2';
			editor.execCommand('undo');
			expect(editor.value).equals('<p>test</p>');
			editor.execCommand('redo');
			expect(editor.value).equals('<p>test2</p>');
		});

		it('Check react UndoRedo to another changes', () => {
			const editor = getJodit({
				history: {
					timeout: 0
				}
			});

			editor.value = 'test';

			const range = editor.s.createRange();
			range.setEnd(editor.editor.firstChild.firstChild, 4);
			range.collapse(false);
			editor.s.sel.removeAllRanges();
			editor.s.sel.addRange(range);

			editor.s.insertNode(editor.createInside.text('test2'));
			editor.execCommand('undo');
			expect(editor.value).equals('<p>test</p>');

			editor.execCommand('redo');
			expect(editor.value).equals('<p>testtest2</p>');
		});
	});

	describe('Clear stack', () => {
		it('Should disable both buttons in toolbar and all calls redo and undo must do nothing', () => {
			const editor = getJodit({
				toolbarAdaptive: false,
				history: {
					timeout: 0
				}
			});

			const undo = getButton('undo', editor);
			expect(undo).is.not.null;
			const redo = getButton('redo', editor);
			expect(redo).is.not.null;

			expect(undo.hasAttribute('disabled')).is.true;
			expect(redo.hasAttribute('disabled')).is.true;

			editor.value = 'test';
			editor.value = 'stop';

			expect(undo.hasAttribute('disabled')).is.false;
			expect(redo.hasAttribute('disabled')).is.true;

			simulateEvent('click', 0, undo);
			expect(editor.value).equals('<p>test</p>');
			expect(undo.hasAttribute('disabled')).is.false;
			expect(redo.hasAttribute('disabled')).is.false;

			simulateEvent('click', 0, redo);
			expect(editor.value).equals('<p>stop</p>');
			expect(undo.hasAttribute('disabled')).is.false;
			expect(redo.hasAttribute('disabled')).is.true;

			editor.history.clear();

			expect(undo.hasAttribute('disabled')).is.true;
			expect(redo.hasAttribute('disabled')).is.true;
			expect(editor.value).equals('<p>stop</p>');

			editor.execCommand('undo');
			expect(undo.hasAttribute('disabled')).is.true;
			expect(redo.hasAttribute('disabled')).is.true;
			expect(editor.value).equals('<p>stop</p>');
		});
	});

	describe('Limited history', () => {
		it('Should store only limited history', () => {
			const editor = getJodit({
				history: {
					maxHistoryLength: 3
				}
			});

			editor.value = '<p>123456789|</p>';

			setCursorToChar(editor);

			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);
			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);
			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);
			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);
			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);
			simulateEvent('keydown', Jodit.KEY_BACKSPACE, editor.editor);

			expect(editor.value).equals('<p>123</p>');

			editor.execCommand('undo');
			editor.execCommand('undo');
			editor.execCommand('undo');
			editor.execCommand('undo');
			editor.execCommand('undo');
			editor.execCommand('undo');

			expect(editor.value).equals('<p>123456</p>');
		});
	});

	describe('Transactions', () => {
		it('should pack all changes inside one and not create history point', () => {
			const editor = getJodit();
			editor.value = '<p>test|</p>';
			setCursorToChar(editor);
			editor.s.insertNode(editor.createInside.text('123'));
			editor.s.insertNode(editor.createInside.text('123'));
			expect(editor.history.length).equals(4);

			editor.history.snapshot.transaction(() => {
				editor.s.insertNode(editor.createInside.text('123'));
				editor.s.insertNode(editor.createInside.text('123'));
				editor.s.insertNode(editor.createInside.text('123'));
			});

			expect(editor.history.length).equals(4);
			expect(editor.value).equals('<p>test123123123123123</p>');
		});

		it('should block the snapshot', () => {
			const editor = getJodit();

			expect(editor.history.snapshot.isBlocked).is.false;

			editor.history.snapshot.transaction(() => {
				expect(editor.history.snapshot.isBlocked).is.true;
				editor.s.insertNode(editor.createInside.text('123'));
				editor.s.insertHTML('123');
				expect(editor.history.snapshot.isBlocked).is.true;
			});

			expect(editor.history.snapshot.isBlocked).is.false;
		});
	});
});
