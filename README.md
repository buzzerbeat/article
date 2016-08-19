# article
## 推荐样式说明

#### type表示新闻类型，取值说明


* type=1，新闻；默认样式，根据style和其他信息组合展示

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/style_multi_pics.png?raw=true)

* type=2，图集新闻；需要特殊处理的样式包含：
	* 在从左数第一张图(有可能是三图，也有可能是大图)的左下标注图集图片数量(n图)，如下图：

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_multi_pics_2.png?raw=true)

* type=3，视频新闻；结构中包含video_info，需要特殊处理的样式包含：
	* 视频时长 
	* 播放按钮(style=1或11时，样式略有不同，见下图)

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_video_large_image.png?raw=true)
![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_video.png?raw=true)


* type=5，推广，广告；需要特殊处理的样式包含：
	* label的颜色为蓝色，与其他label颜色区别开

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_ad.png?raw=true)


* type=6，webview


#### style表示列表样式，取值说明

* style=1，单图样式，建议尺寸300\*196

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_default_hot.png?raw=true)

* style=11，大图(单图)样式，建议尺寸580\*326

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/type_video_large_image.png?raw=true)

* style=2，无图新闻

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/style_no_pic.png?raw=true)

* style=3，多图（三图）新闻，建议尺寸300\*196

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/style_multi_pics.png?raw=true)


#### 其他决定样式字段说明

* title，标题
* coverList，缩略图列表，存储对应style需要用到的图片数据的列表
* relSid，关联资源的sid，type=[1,2]时，sid为新闻接口的sid，type=3时，sid为视频接口的sid，type=[5,6]时，sid为空
* media，文章来源媒体，null不显示
	* avatar：头像图片，null表示没有媒体头像
	* name：媒体名称

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/media_info.png?raw=true)

* pubTime，发表时间，null不显示

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/elapsed.png?raw=true)


* label，标签，null或空不显示(多个标签用逗号分隔，可同时显示多个标签，例如“热，图片”)

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/label1.png?raw=true)

* like_count，赞，null或0时不显示

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/like.png?raw=true)


* comment_count，赞，null或0时不显示

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/comment.png?raw=true)


* can_delete，是否可以删除

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/delete.png?raw=true)

* image_count，图集的图片数量

![Image](https://github.com/buzzerbeat/article/blob/master/web/images/image_count.png?raw=true)


* video_info，视频数据，可选




## 文章推荐API

### 推荐列表API `news`


      [
        {
            "sid": "O4EcMkUs8Yw", //推荐Item sid
            "relSid": "aAwsokgc87O", //关联资源sid
            "type": 1, //type取值：1为普通新闻，2为图集新闻，3为视频新闻/实时，后续支持(视频/精选，广告等类型)
            "style": 0,  //style表示列表样式：0为默认(根据coverList的数量来)，1为单图(3张缩略图)，2为无图，3为多图
            "title": "杨幂发错国旗秒删 重新发了一条微博遭吐槽",
            "abstract": "【 摘要 】杨幂发错国旗，昨天七夕，杨幂没晒出和刘恺威的合照也没晒七夕礼物。而是为中国奥运健儿加油但遭到网友炮轰:连国旗都能发错!随即杨幂秒删该微博。重新发了一条微博，除了国旗换了，别的都没换!看来是发现了!而是为中国奥运健儿加油但遭到网友炮轰:连国旗都能发错!",
            "pubTime": "刚刚",
            "media": {
                  "name": "东方体育日报",
                  "avatar": "EKo2ImD6Mq4",
              },
            "source": "行乐视觉",
            "link": "http://m.jiangsu.china.com.cn/mobile/ent/yldt/6886353_1.html",
            "coverList": [
                {
                    "width": 550,
                    "height": 370,
                    "mime": "image/jpeg",
                    "md5": "f8ff128d7311536c04fc7b0057d0a1b3",
                    "size": 24686,
                    "dynamic": 0,
                    "sid": "O4EcMkrxSYw",
                    "dotExt": ".jpg"
                    
                },
               ...
            ],
            "is_hot": 0/1	
            "behot_time": 
            "is_stick": 0/1 //是否置顶
            "label": //列表item角标
            "like_count":0,
            "comment_count":0,
            "can_delete":0/1,
            "image_count":0,
           
            *"video_info": {
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
        }
      ]


### 文章详情API `/articles`

可选参数(expands)：
* content: 原始content
* appContent: 用于app展示使用; appContent中的<img_sid/>作为替换的标签存在，需要app中对标签的替换为images中对应sid的图片。（将来可以扩充标签<video_sid/><album_sid/>作为视频，图集等资源插入新闻中）
* webContent: 用于后台展示用



            {
         
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


           
            }
