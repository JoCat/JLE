/*
 * JCat Background Image Slider
 * Взят с сайта: http://javascript.ru/forum/showthread.php?p=331963
 * Автор: hfts_rider
 * Доработал: Johny_Cat
 * Работает на JQuery
*/

var imgHead = [
			'/pages/images/1.jpg',
			'/pages/images/2.jpg',
			'/pages/images/3.jpg',
			'/pages/images/4.jpg',
			'/pages/images/5.jpg'
		], i=1;
	function BGSlide(){

		if(i > (imgHead.length-1)){
			$('.placeholder').animate({'opacity':'0'},1000,function(){
				i=1;
				$('.placeholder').css({'background':'url('+imgHead[0]+') 50% 20% / 100%'});
			});
			$('.placeholder').animate({'opacity':'1'},1000);
		}else{
			$('.placeholder').animate({'opacity':'0'},1000,function(){
				$('.placeholder').css({'background':'url('+imgHead[i]+') 50% 20% / 100%'});
				i++;
			});
			$('.placeholder').animate({'opacity':'1'},1000);
		}
		
	}
	var intervalBGSlide = setInterval(BGSlide,15000);