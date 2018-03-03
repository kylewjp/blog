//获取应用实例
var app = getApp();
var fileData = require('../../utils/data.js');

Page({
  data: {
    navbarArray:[
      {
        ac_id: "0",
        ac_name: '全部',
        ac_code: 'navbar-item-active'
      }
    ],
    navbarShowIndexArray:[],
    scrollNavbarLeft: 0,
    articlelist:[],
  },
  onLoad: function () {

    wx.setNavigationBarTitle({
      title: "所有分类",
    })

    this.getArticleList(0);
    let that = this;
    // // this.setData({
    // //   navbarShowIndexArray: Array.from(Array(8).keys()),
      
    // // });

    wx.request({
      url: app.globalData.config.host + '/index.php?op=main',
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        var requestData = res.data;
        console.log(res);

        let articleclass = res.data.articleclass;
        let navbarArray = that.data.navbarArray;
        for(var i in articleclass){
          navbarArray.push(articleclass[i]);
        }
        // console.log(navbarArray);
        that.setData({
          // articleList: requestData.articlelist,
          navbarShowIndexArray: Array.from(Array(10).keys()),
          navbarArray:navbarArray,
        });
      }
    });

    // wx.request({
    //   url: app.globalData.config.host + '/index.php?op=articleClass',
    //   header:{
    //     'content-type':'json'
    //   },
    //   success:function(res){
    //     // console.log(res.data.articleclass);
    //     let articleclass = res.data.articleclass;
    //     let navbarArray = that.data.navbarArray;
    //     for(var i in articleclass){
    //       navbarArray.push(articleclass[i]);
    //     }
    //     // console.log(navbarArray.length);
    //     var length = navbarArray.length;
        
    //     // navbarArray.concat(res.data.articleclass);
    //     // console.log(navbarArray);
    //     that.setData({
    //       navbarArray: navbarArray,
    //       navbarShowIndexArray: Array.from(Array(length).keys()),
    //     });
    //   }
    // });

  },

  getArticleList:function(id){
    let that = this;

    wx.request({
      url: app.globalData.config.host + '/index.php?op=articleClass&ac_id=' + id,
      header: {
        'content-type': 'json'
      },
      success: function (res) {
        var requestData = res.data;
        console.log(res);

        let articleclass = res.data.articleclass;
        let navbarArray = that.data.navbarArray;
        for (var i in articleclass) {
          navbarArray.push(articleclass[i]);
        }
        // console.log(navbarArray);
        that.setData({
          articleList: requestData.articlelist,
          navbarShowIndexArray: Array.from(Array(10).keys()),
          navbarArray: navbarArray,
        });
      }
    });

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

  onTapNavbar: function (e) {
    // console.log(e.currentTarget.dataset.aid);
    this.switchChannel(parseInt(e.currentTarget.id));
    
    this.getArticleList(e.currentTarget.dataset.aid);


  },
  switchChannel: function (targetChannelIndex) {

    let navbarArray = this.data.navbarArray;
    navbarArray.forEach((item, index, array) => {
      item.ac_code = '';
      if (index === targetChannelIndex) {
        item.ac_code = 'navbar-item-active';
      }
    });
    this.setData({
      navbarArray: navbarArray,
    });
  },


  // 跳转至详情页
  navigateDetail: function (e) {
    console.log(e);
    wx.navigateTo({
      url: '../article_detail/article_detail?id=' + e.currentTarget.dataset.aid
    })
  },
  
  
});
