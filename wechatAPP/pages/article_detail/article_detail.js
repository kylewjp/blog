var app = getApp()
var WxParse = require('../../wxParse/wxParse.js')
Page({
  data: {
    article_title:null,
    date:'../../images/date.png',
    article_time:null
  },
  onLoad: function (options) {
    // 文章ID
    var articleID = options.id;
    // console.log('options>>>>>', options, articleID);
    var that = this;
    wx.request({
      url: app.globalData.config.host + '/index.php?op=article_detail&id=' + articleID,
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        // console.log(res.data.content);
        // var article = res.data.map(function (e) { return e.content});
        console.log(res);
        var article = res.data.article_content;
        wx.setNavigationBarTitle({
          title: res.data.article_title,
        })
        that.setData({
            article_title:res.data.article_title,
            article_time:res.data.article_time,
        });
        WxParse.wxParse('article', 'html', article, that, 5);
        
      }
    });

  },
  // 预定
  bookTap: function () {
    wx.navigateTo({
      url: '../book/book'
    })
  }
})