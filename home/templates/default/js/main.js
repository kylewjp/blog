$(function(){
    // 小屏头部导航
    (function(){
        var openNav=$('.openNav'),
            nav=$('#nav'),
            closeNav=nav.find('.closeNav'),
            navLis=nav.find('li'),
            dropMenu=nav.find('.dropMenu'),
            navMask=$('.navMask');
        openNav.click(function(){
            closeNav.show();
            navMask.fadeIn();
            nav.animate({left:0},300);
        });
        navMask.on('click',hideNav);
        closeNav.on('click',hideNav);
        function hideNav(){
            closeNav.hide();
            navMask.fadeOut();
            nav.animate({left:-280},300);
        };
        navLis.each(function(index){
            var navOn=true;
            $(this).children('a').click(function(){
                if(navOn){
                    dropMenu.eq(index).show(300);
                    navOn=false;
                }else{
                    dropMenu.eq(index).hide(300);
                    navOn=true;
                }
            });
        });
    })();


    //轮播图
    (function(){
        carousel($('.banner'),$('.banner .bannerBtn'),$('.banner .bannerPrev'),$('.banner .bannerNext'),3000,240);
        function carousel(obj,aCon,pre,next,times,speed){
            var focusBox=obj.find('ul'),
                focusBoxLis=focusBox.find('li'),
                focusSpans=aCon.find('span'),
                objWidth=obj.width(),
                timer=null,
                n=0;
            change();
            function change(){
                focusBox.css({'width':focusBoxLis.length*objWidth+'px'});
                focusBoxLis.css({'width':objWidth+'px'});
            }
            timer=setInterval(autoplay,times);
            obj.hover(function(){
                clearInterval(timer);
            },function(){
                timer=setInterval(autoplay,times);
            });
            function autoplay(){
                n++;
                if(n>focusSpans.length-1){
                    n=0;
                }
                focusBox.animate({left:-(n*objWidth)},speed);
                focusSpans.removeClass('active').eq(n).addClass('active');
            }
            pre.click(function(){
                n--;
                if(n<0){
                    n=focusSpans.length-1;
                }
                focusBox.animate({left:-(n*objWidth)},speed);
                focusSpans.removeClass('active').eq(n).addClass('active');
            });
            next.click(function(){
                autoplay();
            });
            focusSpans.each(function(index){
                $(this).on('mouseover',function(){
                    focusBox.animate({left:-(index*objWidth)},speed);
                    n=index;
                    focusSpans.removeClass('active').eq(index).addClass('active');
                });
            });
        };
    })();
    (function(){
        var bannerUl=$('.companyNewsBanner').find('ul'),
            bannerLis=bannerUl.find('li'),
            bannerSpans=$('.companyNewsBtn').find('span'),
            cn=0,
            ln=0,
            timer1=null;
        bannerLis.eq(cn).css({'opacity':1,'zIndex':2});
        timer1=setInterval(autoplay,5000);
        $('.companyNewsBanner').hover(function(){
            clearInterval(timer1);
        },function(){
            timer1=setInterval(autoplay,5000);
        });
        function autoplay(){
            cn++;
            if(cn>bannerLis.length-1){
                cn=0;
            }
            bannerLis.eq(ln).stop().animate({opacity:0,zIndex:1},1000);
            bannerLis.eq(cn).stop().animate({opacity:1,zIndex:2},1000);
            bannerSpans.removeClass('active').eq(cn).addClass('active');
            ln=cn;
        }
        bannerSpans.each(function(index){
            $(this).on('click',function(){
                bannerLis.eq(cn).stop().animate({opacity:0,zIndex:1});
                bannerLis.eq(index).stop().animate({opacity:1,zIndex:2});
                bannerSpans.removeClass('active').eq(index).addClass('active');
                ln=cn;
                cn=index;
            });
        });
    })();
    // updateNews文字弹性滑动
    (function (){
        var oDiv = $('.updateNews');
        var oUl = oDiv.find('ul');
        var iH = 0;
        var iNow = 0;
        var timer = null;
        iH = oUl.find('li').height();
        oDiv.hover(function (){
            clearInterval( timer );
        }, autoPlay);
        function autoPlay() {
            timer = setInterval(function () {
                doMove(-1);
            }, 3500);
        }
        autoPlay();
        function doMove( num ) {
            iNow += num;
            if ( Math.abs(iNow) > oUl.find('li').length-1 ) {
                iNow = 0;
            }
            if ( iNow > 0 ) {
                iNow = -(oUl.find('li').length-1);
            }
            oUl.stop().animate({ 'top': iH*iNow }, 2200, 'elasticOut');
        }
    })();
	// tab切换
	(function(){
        tabs($('.tabBox .tab ul'),$('.tabBox .tabItem'),'click');
        function tabs( oNav, aCon, sEvent ) {
            var aElem = oNav.children();
            aCon.hide().eq(0).show();
            aCon.removeClass(' on').eq(0).addClass(' on');
            aElem.each(function(index){
                $(this).on(sEvent, function(){
                    aElem.removeClass('active').eq(index).addClass('active');
                    aCon.hide().eq(index).show();
                    aCon.removeClass(' on').eq(index).addClass(' on');
                });
            });
        }
	})();
    // 底部瀑布流
    (function(){
        if($(window).width()<=600){
            var footnavLeft=$('.footnav_left'),
                majorListLeft=footnavLeft.offset().left,//盒子距离浏览器左边的距离
                masonryItem=footnavLeft.find('.masonry_item'),
                boxWidth=masonryItem.eq(0).outerWidth(true)-1,
                num=Math.floor(footnavLeft.width()/boxWidth),
                majorListLisHArr=[];
            //console.log(num);
            masonryItem.each(function(index){
                var majorListLisH=masonryItem.eq(index).outerHeight(true);
                //console.log(majorListLisH);
                if(index<num){
                    majorListLisHArr[index]=majorListLisH;
                    //console.log(majorListLisHArr[index]);
                }else{
                    var minHeight=Math.min.apply(null,majorListLisHArr);//数组majorListLisHArr中的最小值minHeight
                    //console.log(minHeight);
                    var minIndex=getMinIndex(majorListLisHArr,minHeight);
                    //console.log(minIndex);
                    masonryItem.eq(index).css({
                        'position': 'absolute',
                        'left': masonryItem.eq(minIndex).offset().left-majorListLeft+'px',
                        'top': minHeight+'px',
                    });
                    majorListLisHArr[minIndex]+=masonryItem.eq(index).outerHeight(true);
                }
                var maxHeight=Math.max.apply(null,majorListLisHArr);
                footnavLeft.css({'height':maxHeight+'px'});
            });
            function getMinIndex(boxHArr,minHeight){
                for(var i in boxHArr){
                    if(boxHArr[i]==minHeight){
                        return i;
                    }
                }
            }
            function getMaxIndex(boxHArr,maxHeight){
                for(var i in boxHArr){
                    if(boxHArr[i]==maxHeight){
                        return i;
                    }
                }
            }
        }
    })();
});