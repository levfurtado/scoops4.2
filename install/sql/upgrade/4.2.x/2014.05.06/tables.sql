system php ./move_files.php
UPDATE `liveuser_users` SET `is_admin` = false;
UPDATE liveuser_users l0_ INNER JOIN liveuser_groupusers l2_ ON l0_.Id = l2_.perm_user_id INNER JOIN liveuser_groups l1_ ON l1_.group_id = l2_.group_id AND (l1_.group_id IN (SELECT `group_id` FROM `liveuser_groups`)) SET l0_.is_admin = true;