# article
## 文章推荐API


### 文章详情API


appContent中的<img_sid/>作为替换的标签存在，需要app中对标签的替换为images中对应sid的图片。（将来可以扩充标签<video_sid/><album_sid/>作为视频，图集等资源插入新闻中）：


      {
          "item": {   //由type决定item结构，示例是新闻类型，后续支持视频，推广，问答，专题等。
              "sid": "EKo2Ipy6Mq4",
              "title": "吕斌拳台遭遇不公平判罚，邹市明：里约奥运会不是毁人嘛！",
              "abstract": "北京时间8月9日，2016年里约奥运会结束了第4个比赛日的争夺，中国军团收获颇丰。但是，在拳击赛场上，却发生了一件让人非常遗憾又有些愤怒的事情，中国拳击手吕斌在全场占尽优势的情况下被裁判判罚失败。赛后吕斌哭着吻别拳击场的画面让人惋惜、愤怒！",
              "appContent": "内容内容内容内容内容<img_sid>[sid]</img_sid>",
              "pub_time": 1470751269,
              "media": {
                  "sid": "EKo2ImD6Mq4",
                  "name": "东方体育日报",
                  "avatar": 141103,
                  "description": "最及时的资讯，最高效的服务，有新闻有互动，打造专属自留地。"
              },
              "images": [
                  {
                      "sid": "O4EcMkUvpYw",
                      "index": 0, //序号
                      "img": {
                          "width": 600,
                          "height": 400,
                          "mime": "image/jpeg",
                          "md5": "637e6976c4d01dcf6054dceb98bec079",
                          "size": 21892,
                          "dynamic": 0,
                          "sid": "JmZAbkRMx8L",
                          "dotExt": ".jpg"
                      },
                      "tt_uri": "large/ba600069be3a2920648",
                      "sub_title": "",  //图集类型新闻，单张图片的子标题
                      "sub_abstract": ""  //图集类型新闻，单张图片的子描述
                  },
                ...
              ],
            
              "video": {
                  "sid": "uMwgBg0Mwg0",
                  "video": {
                      "sid": "EKo2K2v6Mq4",
                      "coverImg": {
                          "width": 580,
                          "height": 326,
                          "mime": "image/jpeg",
                          "md5": "76033cd6ec615c9c63c036f84958e929",
                          "size": 19467,
                          "dynamic": 0,
                          "sid": "uM2org0Mwg0",
                          "dotExt": ".jpg"
                      },
                      "length": 210,
                      "width": 640,
                      "height": 360,
                      "size": 0,
                      "url": "http://v7.pstatp.com/1ed001aef338ec09d056fcf1f757f358/57a9be38/video/c/c5299d0cc2bf4efa97a65bae59ded2c4/",
                      "m3u8_url": "",
                      "site_url": "http://toutiao.com/group/6314563472730358273/",
                      "regexSetting": {
                          "type": 3,
                          "site": "toutiao",
                          "app_req_url": "http://i.snssdk.com/video/urls/1/toutiao/mp4/3e44b0eb348548d688a05e71c2c2fad5?callback=tt__video__9vp4me",
                          "pattern": "data &gt; video_list &gt; video_1 &gt; main_url",
                          "matches_index": "",
                          "headers": ""
                      }
                  },
                  "create_time": 1470223877
              },
              
          }
          
          "type": 1, //type取值：1为普通新闻，2为图集新闻，3为视频新闻/实时，后续支持(视频/精选，广告等类型)
          "style": 0,  //style表示列表样式：0为默认(根据coverList的数量来)，1为单图(3张缩略图)，2为无图，3为多图
          "coverList": [  //列表item样式的缩略图列表
              {
                  "sid": "JmZAbOsox8L",
                  "index": 0,
                  "img": {
                      "width": 172,
                      "height": 120,
                      "mime": "image/jpeg",
                      "md5": "90790814235b1ec7138be6cd8317a56e",
                      "size": 3944,
                      "dynamic": 0,
                      "sid": "zcV8LKHo5Ov",
                      "dotExt": ".jpg"
                  },
                  "tt_uri": "list/78f001f32e607d80f00",
                  "sub_title": "",
                  "sub_abstract": ""
              }
           ],
           "tags": [ //对应关键词
              {
                  "sid": "uMwgBg0Mwg0",
                  "name": "中国军团"
              },
             ...
           ],
           
           "pub_time": 1470751269, //发布时间，普通资源排序用
           "is_hot": 0/1	//是否为热门
           "behot_time": //热门资源排序用
           "is_stick": 0/1 //是否置顶
           "be_stick_time":  //置顶开始时间
           "off_stick_time": //置顶结束时间
           "label": //列表item角标
           
      }
