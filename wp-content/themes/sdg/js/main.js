
/* function for the scroller */
$(function () {
	var header = $("#float-header-wrapper"),
		move = Math.abs(parseInt(header.css("top"))),
		move_hidden = parseInt(header.css("top")),
		scrollTop = $(window).scrollTop(), 
		header_down = false;

	//check en el comienzo de la pagina
	if (scrollTop > move) {
		header.css("top", "0px");
	}

	$(window).on("scroll", function () {
		scrollTop = $(this).scrollTop();
	})

	$(window).scrollStopped(function(){
		if(scrollTop > move) {
			header.animate({"top": "0px"}, 100);
		} else {
			header.stop(true,true);
			header.animate({"top": move_hidden + "px"}, 100);
		}
	});
});

/* method from stackoverflow onScrollStop event*/
$.fn.scrollStopped = function(callback) {          
    $(this).scroll(function(){
        var self = this, $this = $(self);
        if ($this.data('scrollTimeout')) {
          clearTimeout($this.data('scrollTimeout'));
        }
        $this.data('scrollTimeout', setTimeout(callback,10,self));
    });
};


/* function for the login menu */
$(function () {
	var toggle = $(".js-login-toggle");
	var form = $(".js-log-form");

	toggle.on("click", function (ev) {
		form.toggleClass("hidden", "no-hidden");
		console.log("")
	});
});

/* toggle show message */
$(function () {
	var message_area = $('#form-message');
	var button = $('.info-mandar-mensaje');

	button.on('click', function (ev) {
		message_area.slideToggle(250);
	});

});


$(function () {
//validador de mail.
var check_form = function () {
	//do it yourself, alta!

	//elementos del formulario
	//form-validator berlinerds!!
	//setting variables: 
	var true_loop = [true] //un true por campo...
	    form = {
		mail: {
			el: $("textarea#mensaje-area"),
			type: "text",
			required: true,
			submitable: false,
			default_val: $("textarea#mensaje-area").text(),
			error_msg: $("textarea#mensaje-area").parent().parent().find(".error_msg")
		},
		submit: {
			el: $("input#submit"),
			type: "submit"
		}
	};

	//var top_message = $(".form_msg").html(),
	console.log('checker initialized');
	var errors_total = 0,
		messages = ["Este campo es obligatorio", "La dirección de correo electrónico es incorrecta"],
		total_messages = "Hemos detectado " + errors_total + "errores. Revise el formulario.",
		submit = false;

	//is_required?
	function check_not_empty (el) {
		
		var value = el.el.val(),
			val_default = el.default_val;

		//console.log(value);
		if (value !== val_default && value !== "" && value !== " ") {
			return true;
		} else {
			return false;
		}	
	}

	//is_mail?
	function is_mail (el) {
		
		var value = el.el.val(),
			regex = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"),
			match = regex.test(value);
		
		if (el.type == "mail") {
			if (match) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	//is submitable
	function check_true(el) {
		
		var mail = is_mail(el),
			not_empty = check_not_empty(el),
			check_loop = [],
			i = 0,
			submit_button = form["submit"].el;

		//gestionar mensajes de error si es necesario
		throw_error(el, mail, not_empty);

		//si pasa la funcion mail y not_empty el objeto es mandable
		if (mail == true && not_empty == true) {
			el.submitable = true;
		} else {
			el.submitable = false;
		}	

		//comprueba cada event-firing el estado de todos los campos
		for (var b in form) {
			if (form[b].type !== "submit") {
				check_loop[i] = (form[b].submitable != null) ? form[b].submitable : null;
				i++;
			}
		}

		console.log(check_loop);

		//si todos los campos son true, habilita deja mandar formulario
		if (check_loop.compare(true_loop) === true) { //mirar referencia array.prototype.compare
			submit = true;
		} else {
			submit = false;
		}

		//console.log(submit);

		//si se puede mandar formulario - dejo clickar en submit-button
		if (submit === true) {
			submit_button.attr("disabled", false);
		} else {
			submit_button.attr("disabled", true);
		}

	}

	//throw_error
	function throw_error(el, mail, not_empty) {

		var error_msg_val = el.error_msg.html(),
			error_msg_element = el.error_msg;
		//console.log(error_msg_val);

		//mostrar error en labels
		if (!not_empty) {
			el.error_msg.text(messages[0]);
			error_msg_element.fadeIn();
		} else if (!mail){
			el.error_msg.text(messages[1]);
			error_msg_element.fadeIn();
			
		} else {
			el.error_msg.text("");
			error_msg_element.fadeOut();
		}

		//mostrar numero total de errores
		//No hace falta en este caso porque no se valida on-submit...
	}

	//aplicar eventos a formularios
	//sacando que elemento del objeto ha sido modificado
	for (var a in form) {
		
		//console.log (form[a].el, form[a].default_val )

		form[a].el.on("focus", function() {
			$(this).on("blur mouseleave mouseout keyup", function (ev) {

				//console.log($(ev.target));
				for (var a in form) {
					if(form[a].el[0] == $(ev.target)[0]) {
						//console.log(form[a]);
						check_true(form[a]);
					}
				}
			});
		});
	}

	//on click hide the error notification
	$(".error_msg").on("click", function () {
		$(this).fadeOut();
	});

	//


	//compare method array.prototype
	//thanks to Tomás Zato - Stackoverflow
	Array.prototype.compare = function (array) {
	    // if the other array is a falsy value, return
	    if (!array)
	        return false;

	    // compare lengths - can save a lot of time
	    if (this.length != array.length)
	        return false;

	    for (var i = 0, l=this.length; i < l; i++) {
	        // Check if we have nested arrays
	        if (this[i] instanceof Array && array[i] instanceof Array) {
	            // recurse into the nested arrays
	            if (!this[i].compare(array[i]))
	                return false;
	        }
	        else if (this[i] != array[i]) {
	            // Warning - two different object instances will never be equal: {x:20} != {x:20}
	            return false;
	        }
	    }
	    return true;
	};
}

check_form();
});


//regular la cantidad de text que se enseña y hacer un SlideDown después...
$(function () {

	var event_first = $('div#event').eq(0);
	//console.log(event_first);
	var url_event = event_first.data('link');
	var url = '';
	console.log(url_event);

	jQuery.ajax({
		type: 'GET',
		url: url_event,
		dataType: 'JSON',
		error: function () {
			console.log("no ha funcionado");
		}, 
		success: function () {
			console.log("ha funcionado!");
		}


	})


});

































