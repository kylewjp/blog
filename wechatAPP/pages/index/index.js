//index.js
//获取应用实例
var app = getApp();
var fileData = require('../../utils/data.js');

Page({
  // 页面初始数据
  data: {
    colors: ['red', 'orange', 'yellow', 'green', 'purple'],
    // banner 初始化
    banner_url: [],
    indicatorDots: true,
    vertical: false,
    autoplay: true,
    interval: 3000,
    duration: 1000,
    // nav 初始化
    navTopItems: [],
    navSectionItems: fileData.getIndexNavSectionData(),
    curNavId: 1,
    curIndex: 0,
    articleList:[],
    // coverpath:[]
  },
  getArticle: function (id) {
    var that = this;
    wx.request({
      url: app.globalData.config.host + '/index.php?op=articleList&id=' + id,
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        var requestData = res.data;
        // console.log('>>>>>>>>>', res);
        that.setData({
          articleList: requestData,
        });
      }
    });
  },
  onLoad: function () {
    var that = this;
    wx.request({
      url: app.globalData.config.host + '/index.php?op=main',
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        var requestData = res.data;
        var picturelist = (requestData.picturelist instanceof Array)?
            requestData.picturelist.map(function(e){return e['url']}):
            [];
        console.log(res);
        that.setData({
          banner_url: picturelist,
          navTopItems: requestData.modellist,
          articleList: requestData.articlelist,
          // coverpath: requestData.articlelist.map(function(e){return e['classname']})
        });
        // that.getArticle(0);
      }
    });
    
  },
  //标签切换
  switchTab: function (e) {
    // console.log(e);
    // console.log(e.currentTarget.dataset.url);

    wx.navigateTo({
      url: e.currentTarget.dataset.url
    })

  },
  // 跳转至详情页
  navigateDetail: function (e) {
    console.log(e);
    wx.navigateTo({
      url: '../article_detail/article_detail?id=' + e.currentTarget.dataset.aid
    })
  },
  // 加载更多
  loadMore: function (e) {
    console.log('加载更多');
    var curid = this.data.curIndex;

    if (this.data.navSectionItems[curid].length === 0) return;

    var that = this;
    that.data.navSectionItems[curid] = that.data.navSectionItems[curid].concat(that.data.navSectionItems[curid]);
    that.setData({
      list: that.data.navSectionItems,
    })
  },
  // book
  bookTap: function (e) {
    wx.navigateTo({
      url: '../book/book?aid=' + e.currentTarget.dataset.aid
    })
  }

})
