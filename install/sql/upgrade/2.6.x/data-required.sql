-- add new events: move and rename template
INSERT INTO Events (Id, Name, Notify, IdLanguage) VALUES (116, 'Rename Template', 'N', 1),(117, 'Move Template', 'N', 1);

-- add new template type 'nontpl' for uniform file management
INSERT INTO TemplateTypes (Id, Name) VALUES ('5','nontpl');

-- Upgrade the system configuration
system php ./upgrade_system_pref.php
-- Upgrade audioclip permissions
system php ./upgrade_user_perms.php
-- Upgrade Campsite users to LiveUser database
system php ./upgrade_liveuser.php
