$(document)
	.ready(function() {

		$('section.tools .' + page.location)
			.addClass('active')
			.html('<span>' + page.location + '</span>');

		$('.actions .action')
			.click(function() {
				$this = $(this);
				var thisClass = $this.attr('class').split(' ')[1];
				if ($this.hasClass('active')) {
					$this.removeClass('active');
					$('form[name="' + thisClass + '"]').hide();
				} else {
					if ($('.actions .action').hasClass('active')) {
						$('.actions .action').removeClass('active');
						$('form').hide();
					}
					$this.addClass('active');
					$('form[name="' + thisClass + '"]').show();
				}
			});

		$('button[type="button"]')
			.click(function() {
				var l = $('body').attr('class'),
					inputData = {},
					newItem = $('.list ul li:nth-child(2)').clone();
				switch (l) {
					case 'admin':
						inputData.e = $('form[name="add"] input[name="e"]').val();
						inputData.n = $('form[name="add"] input[name="n"]').val();
						newItem.find('.name').text(inputData.n);
						newItem.find('.email').html('<a href="mailto:' + inputData.e + '">' + inputData.e + '</a>');
						msg = new Array ('you have added an admin. they have been sent an email with a password.', 'admin not created. please make sure both name and email address are properly filled out.', 'there was a problem creating the admin. please contact your webmaster.');
						break;
					case 'collections':
						inputData.collection = $('form[name="add"] input[name="collection"]').val();
						msg = new Array ('you have added a collection. you can now attach it to an issue.', 'collection not created.', 'there was a problem creating this collection. please contact your webmaster.');
						break;
					case 'issues':
						inputData.n = $('form[name="add_issue"] input[name="issue_number"]').val();
						console.log(inputData);
						msg = new Array ('issue # ' +  inputData.n + ' added.', 'new issue not added. please contact the webmaster.', 'new issue not added. please contact the webmaster.');
						break;
				}
				$.ajax({
					url: 'ajax/' + l + '.php',
					data: inputData,
					success: function(r) {
						if (r) {
							newItem.find('.id').text(r);
							switch (l) {
								case 'collections':
									newItem.find('.name').html('<a href="issues.php?cid=' + r + '">' + inputData.collection + '</a>');
									break;
							}
							switch (page.sort) {
								case 'ASC':
									$('.list ul li:last').after(newItem);
									break;
								default:
									$('.list ul li:nth-child(2)').before(newItem);
									break;
							}
							alert(msg[0]);
						} else {
							alert(msg[1]);
						}
						
					},
					failure: function() {
						alert(msg[2]);
					}
				});
			});
			
		$('.actions .action')
			.click(function() {
//				$('header').after('<section class="message"><div class="container"><h2>something happened</h2></div></section>');
			});
			
		$('body')
			.on('click', '.message', function() {
				$('.message').remove();
			});
			
		$('.action.own')
			.click(function () {
				var newClass = 'inactive',
					newText = 'no';
				if ($(this).hasClass('inactive')) {
						newClass = 'active';
						newText = 'yes';
				}
				$(this)
					.attr('class', 'action own ' + newClass)
					.text(newText);
			});

	});