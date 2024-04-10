var url = 'http://127.0.0.1:8000';
window.addEventListener("load", function(){

	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	// Botón de like
	function like(){
		$('.btn-dislike').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'/img/hearts-64(1).png');

			$.ajax({
				url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
                        location.reload();
						console.log('Has dado like a la publicacion');
					}else{
						console.log('Error al dar like');
					}
				}
			});
			dislike();
		});
	}
	like();

	// Botón de dislike
	function dislike(){
		$('.btn-like').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'/img/favorite-3-64.png');

			$.ajax({
				url: url+'/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
                        location.reload();
						console.log('Has dado dislike a la publicacion');
					}else{
						console.log('Error al dar dislike');
					}
				}
			});

			like();
		});
	}
	dislike();

	// BUSCADOR
	$('#searcher').submit(function(e){
        e.preventDefault()
        const newUrl = url + '/people/'+$('#searcher #search').val();
        console.log(newUrl)
        window.location.href = newUrl;
	});

});
