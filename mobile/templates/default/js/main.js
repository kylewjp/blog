$(function(){
	// 轮播图
	(function(){
		if($('div').hasClass('carousel')){
		    var swiper = new Swiper('.swiper-container', {
		        pagination: '.swiper-pagination',
		        slidesPerView: 1,
		        paginationClickable: true,
		        loop: true
		    });
	    }
	})();
    // tab切换
    (function(){
        fnTab( $('.intop ul'), $('.tab'), 'click' );
        function fnTab( oNav, aCon, sEvent ) {
            var aElem = oNav.children();
            aCon.hide().eq(0).show();
            aElem.each(function (index){
                $(this).on(sEvent, function (){
                    aElem.removeClass('active').eq(index).addClass('active');
                    aCon.hide().eq(index).show();
                });
                
            });
        }
    })();
});