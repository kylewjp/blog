//index.js
//获取应用实例
var app = getApp();
Page({
  // 页面初始数据
  data: {
    articleList: []     // 文章列表
  },
  getArticle: function (id) {
    var that = this;
    wx.request({
      url: app.globalData.config.host + '/index.php?op=articleList',
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        
        var requestData = res.data;
        // console.log(res.data);
          that.setData({
            articleList: requestData
          });
        }
        
      });
  },
  onLoad: function (options) {
    var id = options.id;
    this.getArticle(id);
    wx.setNavigationBarTitle({
      title: "所有文章",
    })
  },
  //标签切换
  switchTab: function (e) {
    // console.log(e);
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
      list: that.data.navSectionItems
    })
  },
  // book
  bookTap: function (e) {
    wx.navigateTo({
      url: '../book/book?aid=' + e.currentTarget.dataset.aid
    })
  }

});
