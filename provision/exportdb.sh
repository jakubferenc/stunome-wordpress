sudo mkdir -p /vagrant/backup
echo "Backing up db..."
sudo mysqldump --add-drop-database -u root -p'password' 19218_cleanstyle_dev > /vagrant/backup/db.sql
echo "DB backup done."