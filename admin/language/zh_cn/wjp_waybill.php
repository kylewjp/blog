<?php
defined('InShopNC') or exit('Access Invalid!');

$lang['wjp_waybill_list']				= '运单列表';
$lang['wjp_waybill_list']				= '运单列表';
$lang['wjp_waybill_add']				= '添加运单';
$lang['wjp_waybill_input_keyword']		= '请输入关键字';
$lang['wjp_waybill_input_not_fount']	= '没有找到';
$lang['wjp_waybill_input_choose']		= '相关的选项';


$lang['wjp_driver_name']				= '司机名';
$lang['wjp_driver_phone']				= '司机电话';
$lang['wjp_driver_idcard']				= '身份证号码';
$lang['wjp_driver_cartype']				= '车型';
$lang['wjp_driver_carnum']				= '车牌号';
$lang['wjp_driver_belong']				= '司机归属';
$lang['wjp_driver_edit']				= '修改';
$lang['wjp_driver_del']					= '删除';

$lang['wjp_driver_in_driver']			= '公司内编司机';
$lang['wjp_driver_out_driver']			= '外来散户司机';
		  
/**
 * 运单列表
 */
$lang['wjp_waybill_num']				= '运单单号';
$lang['wjp_waybill_statement_account']	= '对账单号';
$lang['wjp_waybill_start']				= '出发地';
$lang['wjp_waybill_end']				= '目的地';
$lang['wjp_waybill_parameter']			= '件数/重量/体积';
$lang['wjp_waybill_parameter0']			= '独立输入';
$lang['wjp_waybill_parameter1']			= '件数';
$lang['wjp_waybill_parameter2']			= '重量';
$lang['wjp_waybill_parameter3']			= '体积';

$lang['wjp_waybill_price_transport']	= '运费';
$lang['wjp_waybill_price_cost']			= '成本价';
$lang['wjp_waybill_price_carry']		= '搬运费';
$lang['wjp_waybill_price_store']		= '仓储费';
$lang['wjp_waybill_price_employ']		= '退佣';
$lang['wjp_waybill_price_hight']		= '高速费';
$lang['wjp_waybill_price_gonight']		= '压夜费';
$lang['wjp_waybill_price_paid']			= '垫付';

$lang['wjp_sell_personel_id']			= '销售人id';
$lang['wjp_driver_id']					= '司机id';
$lang['wjp_duty_personel_id']			= '负责人id';
$lang['wjp_operate_personel_id']		= '操作人id';
$lang['wjp_status_id']					= '状态id';
$lang['wjp_transport_type_id']			= '运货类型id';
$lang['wjp_company_id']					= '公司id';
$lang['wjp_waybill_time_search']		= '查询日期';
$lang['wjp_waybill_time_start']			= '提货时间';
$lang['wjp_waybill_time_entering']		= '录入时间';
$lang['wjp_waybill_time_end']			= '交货时间';
$lang['wjp_waybill_pingche']			= '拼/单';

$lang['wjp_waybill_sell_personel']		= '销售员';
$lang['wjp_waybill_company']			= '客户公司';
$lang['wjp_waybill_duty_person']		= '客户负责人';
$lang['wjp_waybill_operate_person']		= '操作员';
$lang['wjp_waybill_driver']				= '司机';
$lang['wjp_waybill_carnum']				= '车牌';
$lang['wjp_waybill_transport_type']		= '运单类型';
$lang['wjp_waybill_transport_price_sum']= '运单总费用';
$lang['wjp_waybill_transport_status']	= '运单状态';

$lang['wjp_waybill_pagenum']			= '每页显示的数量';

$lang['wjp_driver_setting']				= '司机配备';
$lang['wjp_waybill_cartype']			= '司机车型';
$lang['wjp_driver_choose']				= '选择司机';
$lang['wjp_company_choose']				= '选择公司';
$lang['wjp_duty_personel_choose']		= '选择负责人';
$lang['wjp_sell_personel_choose']		= '选择销售者';
$lang['wjp_operate_person_choose']		= '选择操作人';
$lang['wjp_waybill_status_choose']		= '选择状态';
$lang['wjp_waybill_choose_rand']		= '（可选，可不选）';
$lang['wjp_waybill_money_danwei']		= '元';

$lang['wjp_waybill_driver_empty']		= '该司机在该时段空闲';
$lang['wjp_waybill_driver_full']		= '该司机在该时段运货中';
$lang['wjp_waybill_edit']				= '修改';
$lang['wjp_waybill_del']				= '删除';

$lang['wjp_waybill_excel_out']			= '导出Excel';

$lang['wjp_waybill_in_personel']		= '系统主运单';
$lang['wjp_waybill_broother_personel']	= '系统分运单';
$lang['wjp_waybill_out_personel']		= '外来客户运单';

$lang['wjp_waybill_nodriver']			= '【暂未安排司机】';

/**
 * 运单添加
 */
$lang['wjp_duty_personel_id_null']		= '请先选择客户公司负责人，如没有请先添加';
$lang['wjp_driver_id_null']				= '请先选择司机，如没司机，请先添加';
$lang['wjp_waybill_parameter_null']		= '件数/体积/重量不能为空';
$lang['wjp_waybill_statement_account_null']= '对账单号不能为空';
$lang['wjp_waybill_start_null']			= '出发地目的地不能为空';
$lang['wjp_waybill_start_max']			= '出发地目的地长度范围是1-10';


/**
 * 运单修改
 */
$lang['wjp_waybill_edit_success']			= '更新成功';
$lang['wjp_waybill_edit_fail']				= '更新失败';
$lang['wjp_waybill_edit_admin_error']		= '运单信息错误';
$lang['wjp_waybill_type_edit_tip']			= '请选择运单类型';
$lang['wjp_waybill_duty_edit_tip']			= '请选择运单默认负责人';
$lang['wjp_waybill_duty_null']				= '没数据，请先添加运单的成员在来设定负责人';


