### Vnews' restful interfaces Documents
---
**访问格式为：**http://ip:port/vnews/path

#### 一、用户系统
- 登录 　　  POST
	 路径：　　login 
	 提交数据：{username, password} (username可以是手机号，也可以是用户名，password为md5格式)
	 返回值：　json{code:?} 0代表成功 1代表用户名不存在, 2代表密码不正确
	 
- 注册 　　　　POST
	路径：　　register 
	提交数据：{telephone, username, password} 
	返回值：　json{code:?} 0代表成功 1代表用户名已存在
	
- 检测手机账号是否存在 GET
	路径：　　user/{telephone} 
	返回值：　json{code:?} 0代表不存在 1代表存在
	
- 更新用户信息 PUT (优先PUT, 或者POST)
 	路径：　　user/{username}
 	提交数据：{map} (一个map的映射关系) 
 	返回值：　json{code:?} 0代表成功 1代表失败
 	
 - 上传图片 　　POST
 	路径：　　user/{username}/image
 	提交数据：文件
 	返回值：　json{code:?} 0代表成功 1代表失败
 	
 - 获取用户信息 GET
 	路径：　　user/{username}
 	返回值：　json{} 对应用户基本信息，用户名，头像。。。
 	
#### 二、新闻系统 (按发布时间排序)
- 获取新闻列表按类别   GET　
	路径：　　news/{category}　(category缺省则获取全部类型)
	提交数据：{start, count} 
	返回值：　json{} 新闻简单列表 news_id, title, description, imageurl.

- 获取最热的新闻列表   GET
	路径：　　news/hots
	提交数据：{count} 
	返回值：　json{} 新闻简单列表 news_id, title, description, imageurl.
	
- 获取新闻详情 GET
	路径：　　news/{news_id}
	返回值：　json{} 新闻详情

- 个人喜欢新闻列表 GET
	路径：　　news/{user_id}/likes
	提交数据：{category:?, start:?, count:?} (待定) 
	返回值：　json{} 新闻简单列表 news_id, title, description, imageurl.

- 添加喜欢新闻 POST
	路径：　　news/{user_id}/like/{news_id}
	返回值：　json{code:?} 0代表成功 1代表失败

- 检查是否喜欢某个新闻 POST
	路径：　　news/{user_id}/like/{news_id}
	返回值：　json{code:?} 0代表喜欢 1代表不喜欢

- 浏览新闻 POST
	路径：　　news/view/{news_id}
	提交数据：{user_id:?}
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 删除个人喜欢新闻 DELETE
	路径：　　news/{user_id}/like/{news_id}
	返回值：　json{code:?} 0代表成功 1代表失败

#### 二、单词系统

- 查找单词 GET
	路径：　　words/search/{words}
	返回值：　json{map} 单词详情
	
- 获取标记单词列表 　GET
	路径：　　words/{user_id}/tags
	提交数据：　{tag_type:?，start:?, count:?} (待定) 
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 标记单词 　   POST
	路径：　　words/{user_id}/tag/{words_id}
	提交数据：{tag:?} 标记类型
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 更改标记单词 PUT
	路径：　　words/{user_id}/tag/{words_id}
	提交数据： {tag_type:?}
	返回值：　json{code:?} 0代表成功 1代表失败

- 删除标记单词 DELETE
	路径：　　words/{user_id}/tag/{words_id}
	返回值：　json{code:?} 0代表成功 1代表失败
	
#### 三、评论系统

- 添加评论　POST
	路径：　　news/comment
	提交数据：　{news_id:?，username:?, to_user_id:?} (to_user_id可以为空) 
	返回值：　json{code:?} 0代表成功 1代表失败

- 获取某个新闻的评论　GET
	路径：　　news/comments/{news_id}
	提交数据：　{start:?, count:?}
	返回值：　json{map} 返回评论列表

- 喜欢某个新闻的评论　GET
	路径：　　news/comment/{comment_id}/like
	提交数据：　{user_id:?}
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 取消某个新闻的评论　DELETE
	路径：　　news/comment/{comment_id}/like
	提交数据：　{user_id:?}
	返回值：　json{code:?} 0代表成功 1代表失败
	
#### 四、用户偏好

- 添加偏好　POST
	路径：　　user/{user_id}/preference
	提交数据：　{preference:?} ? 可表示　world,business以逗号分割
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 更改偏好　PUT
	路径：　　user/{user_id}/preference
	提交数据：　{preference:?} ? 可表示　world,business以逗号分割
	返回值：　json{code:?} 0代表成功 1代表失败
	
- 获取偏好　GET
	路径：　　user/{user_id}/preference
	返回值：　json{map} 喜好列表