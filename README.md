# AUTO-REACTIONS-NEW-STATUS FOR LIST USER
[![GitHub forks](https://img.shields.io/github/forks/duongtuanqb/AUTO-REACTIONS-NEW-STATUS)](https://github.com/duongtuanqb/AUTO-REACTIONS-NEW-STATUS/network)
[![GitHub stars](https://img.shields.io/github/stars/duongtuanqb/AUTO-REACTIONS-NEW-STATUS)](https://github.com/duongtuanqb/AUTO-REACTIONS-NEW-STATUS/stargazers)
[![GitHub license](https://img.shields.io/github/license/duongtuanqb/AUTO-REACTIONS-NEW-STATUS)](https://github.com/duongtuanqb/AUTO-REACTIONS-NEW-STATUS/blob/master/LICENSE)

Tự động Reactions khi crush đăng status mới. 😏

Bạn đang crush một ai đó, và muốn là người đầu  tiên Reactions (Cảm xúc)  tatus của crush bằng tốc độ ánh sáng ( crush vừa đăng status cái là mình Reactions liền 😎 ). Tool này sẽ giúp bạn làm điều đó =)))
# Cài đặt
1. Sửa File `index.php` 
```
define('ACCESS_TOKEN', 'YOUR_ACCESS_TOKEN'); // Token của nick bạn
$list_user = ['ID_1', 'ID_2']; // Thay ID_1, ID_2
define('YOUR_USER_ID', 'USER_ID'); // ID nick bạn
$list_reaction = ['LIKE', 'LOVE', 'WOW', 'HAHA', 'SAD', 'ANGRY']; // Có thể xoá các reaction không muốn.
```
2. Up file PHP lên host của bạn.
3. Tạo cronjob: `* * * * * curl url-file-php-vua-upload`
4. Hóng Crush Post status để test :))
5. Tất cả quá trình Reactions đều được lưu vào file `log.txt`

![image](https://i.imgur.com/Ml5Tka6.png)
