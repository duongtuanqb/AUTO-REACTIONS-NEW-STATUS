# AUTO-REACTIONS-NEW-STATUS FOR ONE USER
Tự động Reactions khi crush đăng status mới. 😏

Bạn đang crush một ai đó, và muốn là người đầu  tiên Reactions (Cảm xúc)  tatus của crush bằng tốc độ ánh sáng ( crush vừa đăng status cái là mình Reactions liền 😎 ). Tool này sẽ giúp bạn làm điều đó =)))
# Cài đặt
1. Sửa File `index.php` 
```
define('ACCESS_TOKEN', 'YOUR_ACCESS_TOKEN'); // Token của nick bạn
define('CRUSH_USER_ID', 'USER_ID'); // ID nick crush muốn auto
define('YOUR_USER_ID', 'USER_ID'); // ID nick bạn
```
2. Up file PHP lên host của bạn.
3. Tạo cronjob: `* * * * * curl url-file-php-vua-upload`
4. Hóng Crush Post status để test :))
5. Tất cả quá trình Reactions đều được lưu vào file `log.txt`

![image](https://i.imgur.com/Ml5Tka6.png)
