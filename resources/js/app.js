import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function(){
    console.log('jQuery Works fine');
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $(document).on('submit', '#inputLinkForm', function (event) {
        event.preventDefault()

        let formData = new FormData(this);
        
        let counter
        
        if(!$('#results li:first').val()) {
            counter = 1
        } else {
            counter = $('#results li:first').val() + 1
        }

        formData.set('counter', counter)
        formData.set('outputLink', shortenLink(counter,getDomain(formData.get('inputLink'))))

        $.ajax({
            url: "/",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                console.log(response)
                
                let list = `<li class="m-2 p-2 mx-5 text-blue-500 underline " value="${response.counter}"><a href="${response.inputLink}" target="_blank">${response.outputLink}</a></li>`
                
                if ($('#results li').length == 10) {
                    $('#results li:last').remove()
                }
                $('#results').prepend(list)

                $('#msg').remove()

                $('#inputLinkForm')[0].reset();
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#inputDiv').prepend(`<p id="msg" class="text-red-600 text-xs italic">Такая ссылка уже есть.</p>`)
            }
        });

        function shortenLink(counter, urlInput) {
            counter -= 1
            const base = 3
            const baseUrl = `${urlInput}/`;
            let shortenedLink = '';
          
            let num = counter;
            
            do {
              const remainder = num % base;
              shortenedLink = String.fromCharCode(97 + remainder) + shortenedLink;
              num = Math.floor(num / base) - 1;
            } while (num >= 0);
          
            const fullLink = baseUrl + shortenedLink;
          
            counter++;
            
            return fullLink;
        }

        function getDomain(url) {
            let parsedUrl = new URL(url);
            let domain = parsedUrl.hostname;
          
            let parts = domain.split('.');
            if (parts.length > 2) {
              domain = parts.slice(1).join('.');
            }
          
            return domain;
        }
    })
});