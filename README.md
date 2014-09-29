<h3>关于登录总时间，给出设计方案。</h3>
<h4>http请求是无状态的，如果用户没有点击注销，我们无法直接的获取用户是否在线。只有通过别的办法判断用户是否离线</h4>
<h4>一种方案是，在数据库表table1中存两个时间，一个是登录时间t1，一个是登录之后的访问时间t2。写一个基类，用户每次访问都先走这个基类，访问一次就更新一次t2为当前时间，</h4>
<h4>并设置一个过期时间，例如expire=20分钟，如果  当前时间-t2>20  则说明用户不在线，根据这样统计用户是否在线 ，（注：这里用crontab的定时脚本去跑table1这个表，把now()-t2 看是否大于20）</h4>
<h4>总在线时间，由上面扩展开，把t2-t1即为每一次的登录时间，然后跟数据库原积累的总时间累加即可</h4>

<h3>这种方案有不足，例如如果用户停在一个页面很久（大于20分钟），不操作，我们后台crontab的脚本也判定用户离线了，因此这个方案不是一个精确的统计方案</h3>

伪代码：
```
class commonAction extends Action(){   //基类，用户更新每次的访问时间（登入时间不变化）
  funtion _init(){   //初始化函数，每次访问执行此函数
    insert login_time to mysql;
    insert update_time to mysql;
  }
  
  
}

class A extends commonAction{
  #do something
}

class B extends commonAction{
  #do something
}

class C extends commonAction{
  #do something
}

D E F 
.
.
```
