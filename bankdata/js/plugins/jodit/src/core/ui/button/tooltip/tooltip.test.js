/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2024 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

('tooltip' in window.skipTest ? describe.skip : describe)(
	'Tooltip plugin tests',
	function () {
		const OPTIONS = {
			toolbarAdaptive: false,
			useNativeTooltip: false,
			buttons: ['bold', 'italic', 'underline', 'align'],
			showTooltipDelay: 50,
			language: 'en'
		};

		let timers;

		beforeEach(() => {
			timers = mockTimers();
			box.style.minHeight = '300px';
			box.style.padding = '50px';
		});

		afterEach(() => {
			timers.cleanup();
			box.style.minHeight = '';
			box.style.padding = '';
		});

		describe('Native tooltip', () => {
			it('Should have different tooltip for each language', () => {
				const editor = getJodit({
					...OPTIONS,
					useNativeTooltip: true
				});

				const title = getButton(
					'bold',
					editor
				).parentElement.getAttribute('title');
				expect(title).is.not.null;

				editor.destruct();

				const editor2 = getJodit({
					...OPTIONS,
					useNativeTooltip: true,
					language: 'de'
				});

				const title2 = getButton(
					'bold',
					editor2
				).parentElement.getAttribute('title');
				expect(title2).is.not.null;

				expect(title).does.not.equal(title2);
				expect(title).equals('Bold');
				expect(title2).equals('Fett');
			});
		});

		describe('Jodit tooltip', () => {
			let editor, button1, button2, button3, button4;

			function getTooltipElm() {
				return editor.ownerDocument.querySelector('.jodit-ui-tooltip');
			}

			beforeEach(async () => {
				editor = getJodit(OPTIONS);

				button1 = getButton('bold', editor);
				button2 = getButton('italic', editor);
				button3 = getButton('underline', editor);
				button4 = getButton('justify', editor);

				await editor.async.requestIdlePromise();
			});

			describe('On enter button', () => {
				it('Should show tooltip', () => {
					simulateEvent('mouseenter', button1.parentElement);
					timers.delay(100);
					const tooltip = getTooltipElm();
					expect(tooltip).is.not.null;
					expect(tooltip.textContent).equals('Bold');
				});

				describe('On leave button', () => {
					it('Should hide tooltip', () => {
						simulateEvent('mouseenter', button1.parentElement);
						timers.delay(100);
						expect(getTooltipElm().textContent).equals('Bold');
						simulateEvent('mouseleave', button1.parentElement);
						timers.delay(100);
						const tooltip = getTooltipElm();
						expect(tooltip.textContent).equals('');
					});

					describe('Inside popup', () => {
						it('Should hide tooltip', async () => {
							clickTrigger('left', editor);
							const popup = getOpenedPopup(editor);
							simulateEvent(
								'mouseenter',
								getButton('center', popup).parentElement
							);
							timers.delay(100);
							expect(getTooltipElm().textContent).equals(
								'Align Center'
							);

							simulateEvent('mouseleave', popup.parentElement);
							timers.delay(100);

							const tooltip = getTooltipElm();
							expect(tooltip.textContent).equals('');
						});
					});
				});

				describe('On leave editor', () => {
					it('Should hide tooltip', () => {
						simulateEvent('mouseenter', button1.parentElement);
						timers.delay(100);
						expect(getTooltipElm().textContent).equals('Bold');
						simulateEvent('mouseleave', editor.container);
						timers.delay(100);
						expect(getTooltipElm().textContent).equals('');
					});
				});

				describe('On scroll page', () => {
					it('Should hide tooltip', () => {
						simulateEvent('mouseenter', button1.parentElement);
						timers.delay(100);
						expect(getTooltipElm().textContent).equals('Bold');

						simulateEvent('scroll', editor.ownerWindow);

						timers.delay(100);
						expect(getTooltipElm().textContent).equals('');
					});
				});

				describe('Inside popup', () => {
					it('Should show tooltip', () => {
						editor.value = '<p><a href="index.html">test</a></p>';
						simulateEvent(
							'click',
							editor.editor.querySelector('a')
						);

						const popup = getOpenedPopup(editor);
						expect(popup).is.not.null;
						const editLink = getButton('link', popup);
						expect(editLink).is.not.null;
						simulateEvent('mouseenter', editLink.parentElement);
						timers.delay(100);
						const tooltip = getTooltipElm();
						expect(tooltip).is.not.null;
						expect(tooltip.textContent).equals('Edit link');
					});
				});
			});

			it('Should have different tooltip for each language', () => {
				simulateEvent('mouseenter', button1.parentElement);
				timers.delay(100);
				let tooltip = getTooltipElm();
				expect(tooltip).is.not.null;

				const title = tooltip.textContent;

				editor.destruct();

				editor = getJodit({
					...OPTIONS,
					language: 'de'
				});

				Jodit.modules.Helpers.scrollIntoViewIfNeeded(
					editor.editor,
					editor.ed.body,
					editor.ed
				);

				button1 = getButton('bold', editor);
				expect(button1).is.not.null;
				simulateEvent('mouseenter', button1.parentElement); // toolbar-button
				timers.delay(100);
				tooltip = getTooltipElm();

				expect(tooltip).is.not.null;
				expect(tooltip.textContent).equals('Fett');
				simulateEvent('mouseleave', button1.parentElement);
				expect(tooltip.parentNode).is.not.null;

				expect(parseInt(tooltip.style.left, 10)).equals(-5000);

				expect(title).does.not.equal(tooltip.textContent);
				expect(title).equals('Bold');
				expect(tooltip.textContent).equals('');
			});

			describe('Show one tooltip button', () => {
				let tooltip, title;

				beforeEach(() => {
					simulateEvent('mouseenter', button1.parentElement);

					timers.delay(100);
					tooltip = getTooltipElm();

					expect(tooltip).is.not.null;

					title = tooltip.textContent;
					simulateEvent('mouseleave', button1.parentElement);
					expect(title).equals('Bold');
				});

				describe('Fast enter other button', () => {
					it('Should show different tooltip', () => {
						timers.delay(10);
						simulateEvent('mouseenter', button2.parentElement);
						timers.delay(100);
						tooltip = getTooltipElm();
						expect(tooltip).is.not.null;
						expect(tooltip.textContent).equals('Italic');
						expect(title).equals('Bold');
					});

					describe('Through other buttons', () => {
						it('Should show last tooltip', () => {
							timers.delay(10);
							simulateEvent('mouseleave', button1.parentElement);
							timers.delay(10);
							simulateEvent('mouseenter', button2.parentElement);
							timers.delay(10);
							simulateEvent('mouseleave', button2.parentElement);
							timers.delay(10);
							simulateEvent('mouseenter', button3.parentElement);
							timers.delay(100);
							tooltip = getTooltipElm();
							expect(tooltip.textContent).equals('Underline');
						});
					});

					describe('Fast leave', () => {
						it('Should not show any tooltip', () => {
							timers.delay(10);
							simulateEvent('mouseenter', button2.parentElement);
							timers.delay(10);
							simulateEvent('mouseleave', button2.parentElement);
							timers.delay(100);
							tooltip = getTooltipElm();
							expect(tooltip.textContent).equals('');
						});
					});
				});
			});

			describe('Inside popup', () => {
				describe('Hiding popup', () => {
					it('should hide it tooltip', () => {
						editor.value = '<p><a href="index.html">test</a></p>';
						simulateEvent(
							'click',
							editor.editor.querySelector('a')
						);

						const popup = getOpenedPopup(editor);
						expect(popup).is.not.null;
						const editLink = getButton('link', popup);
						expect(editLink).is.not.null;
						simulateEvent('mouseenter', editLink.parentElement);

						timers.delay(100);
						const tooltip = getTooltipElm();
						expect(tooltip).is.not.null;
						expect(tooltip.textContent).equals('Edit link');

						simulateEvent('click', editor.editor);
						timers.delay(100);
						expect(getOpenedPopup(editor)).is.null;
						expect(getTooltipElm().textContent.trim()).equals('');
					});
				});
			});
		});
	}
);
