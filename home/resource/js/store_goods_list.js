$(function(){
	$('a[ny_type="inline_edit"]').live('click',function(){
		var i_id    = $(this).attr('fieldid');
		var i_name  = $(this).attr('fieldname');
		var i_src   = $(this).attr('src');
		var i_val   = ($(this).attr('fieldvalue'))== 0 ? 1 : 0;
		var ajax_branch      = $(this).attr('ajax_branch');
		$.get('index.php?act=store_goods_online&op=ajax',{branch:ajax_branch,id:i_id,column:i_name,value:i_val},function(data){
		if(data == 'true')
			{
				if(i_val == 0){
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('enabled','disabled'),'title':('开启','关闭'),'fieldvalue':i_val});
				}else{
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('disabled','enabled'),'title':('关闭','开启'),'fieldvalue':i_val});
				}
			}else{
				alert('响应失败');
			}
		});
	});
    // ajax获取商品列表
    $('i[nctype="ajaxGoodsList"]').toggle(
        function(){
            $(this).removeClass('icon-plus-sign').addClass('icon-minus-sign');
            var _parenttr = $(this).parents('tr');
            var _commonid = $(this).attr('data-comminid');
            var _div = _parenttr.next().find('.ncsc-goods-sku');
            if (_div.html() == '') {
                $.getJSON('index.php?act=store_goods_online&op=get_goods_list_ajax' , {commonid : _commonid}, function(date){
                    if (date != 'false') {
                        var _ul = $('<ul class="ncsc-goods-sku-list"></ul>');
                        $.each(date, function(i, o){
							var images_path=ShopSiteUrl;
							var class_is_prize='disabled';
							var value_is_prize='0';
							if(o.is_prize=='1'){
								class_is_prize='enabled';
								value_is_prize='1';
							}
							var class_is_weidian_default='disabled';
							var value_is_weidian_default='0';
							if(o.is_weidian_default=='1'){
								class_is_weidian_default='enabled';
								value_is_weidian_default='1';
							}
							//生成二维码连接
							var add_cart_url = WapSiteUrl+'/tmpl/member/wjp_add_cart.html?quantity=1&goods_id='+o.goods_id;
							var images_qrcode_url=gerQrcodeUrl(add_cart_url);
                            $('<li><div class="goods-thumb" title="商家货号：' + o.goods_serial + '"><a href="' + o.url + '" target="_blank"><image src="' + o.goods_image + '" ></a></div>' + o.goods_spec + '<div class="goods-price">价格：<em title="￥' + o.goods_price + '">￥' + o.goods_price + '</em></div><div class="goods-storage" ' + o.alarm + '>库存：<em title="' + o.goods_storage + '" ' + o.alarm + '>' + o.goods_storage + '</em></div><a href="' + o.url + '" target="_blank" class="ncsc-btn-mini">查看商品详情</a>'
							
					+'<div class="yes-onoff">'
					+'<a href="javascript:void(0);" '
					+'class="'+class_is_prize+'"'
					+ ' ajax_branch="goods_is_prize"  ny_type="inline_edit" '
					+' fieldvalue="'+value_is_prize+'" '
					+ ' fieldid="'+o.goods_id+'" '
					+ ' fieldname="is_prize">'
					+ '<img src="'+images_path+'/templates/default/images/transparent.gif"/>'
					+'</a><img src="'+images_path+'/templates/default/images/seller/product_jiangpin.png" width="60px" height="35px"></div>'
					
					+'<div class="yes-onoff">'
					+'<a href="javascript:void(0);" '
					+'class="'+class_is_weidian_default+'"'
					+ ' ajax_branch="goods_is_weidian_default"  ny_type="inline_edit" '
					+' fieldvalue="'+value_is_weidian_default+'" '
					+ ' fieldid="'+o.goods_id+'" '
					+ ' fieldname="is_weidian_default">'
					+ '<img src="'+images_path+'/templates/default/images/transparent.gif"/>'
					+'</a><img src="'+images_path+'/templates/default/images/seller/product_weidian.png" width="60px" height="35px"></div>'
					
					+'<div class="yes-onoff">'
					+'<div>加入购物车二维码：</div>'
					//+'<div>'+add_cart_url+'</div>'
					+'<div><img src="'+images_qrcode_url+'" width="100px" height="100px"></div>'
					+'</div>'
					
					+'</li>'
					).appendTo(_ul);
                        });
                        _ul.appendTo(_div);
                        _parenttr.next().show();
                        _div.perfectScrollbar();
                    }
                });
            } else {
            	_parenttr.next().show()
            }
        },
        function(){
            $(this).removeClass('icon-minus-sign').addClass('icon-plus-sign');
            $(this).parents('tr').next().hide();
        }
    );
	
	//获取utl的二维码图片链接
    function gerQrcodeUrl(url){
		var jumpUrl =encodeURIComponent(url);
		//alert(jumpUrl);
		var qrurl="http://www.mphelper.net/qr/img.php?d=" + jumpUrl;
		return qrurl;
    }
});