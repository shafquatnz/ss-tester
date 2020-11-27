# Quick start

If you have followed along with a quick start guide and have a Silverstripe setup on an Ubuntu 16 VM, here is how to proceed with installing this in the VM.

## Install SSPAK

```
wget https://silverstripe.github.io/sspak/sspak.phar
chmod +x sspak.phar
sudo mv sspak.phar /usr/local/bin/sspak
```

## Install site code

```
git clone https://github.com/shafquatnz/ss-tester.git testsite
cd testsite
composer install
cp .env.example .env
nano .env
```
Suggested values for the file .env:

```
SS_DATABASE_CLASS="MySQLDatabase"
SS_DATABASE_NAME="testsite"
SS_DATABASE_SERVER="localhost"
SS_DATABASE_USERNAME="silverstripe"
SS_DATABASE_PASSWORD="secret"
SS_DEFAULT_ADMIN_USERNAME="admin"
SS_DEFAULT_ADMIN_PASSWORD="admin"
SS_ENVIRONMENT_TYPE="dev"
```

Build site, create site database and give permission to web server:

```
sspak load site.sspak
vendor/bin/sake dev/build flush=all
HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/assets
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/assets
```

## Configure web server

```
sudo nano /etc/apache2/sites-available/testsite.conf
```

Contents of file testsite.conf

```
<VirtualHost *:80>
	ServerName testsite.test
	ServerAdmin root@localhost
	DocumentRoot /var/www/testsite
	<Directory /var/www/testsite/>
		Options +FollowSymlinks
		AllowOverride All
		Require all granted
	 </Directory>
	ErrorLog ${APACHE_LOG_DIR}/testsite-error.log
	CustomLog ${APACHE_LOG_DIR}/testsite-access.log combined
</VirtualHost>
```

Create symlinks, load site config:

```
sudo ln -s /home/ubuntu/testsite/public /var/www/testsite
sudo a2ensite testsite
sudo systemctl reload apache2
```

Note: in above change the home folder from ubuntu to your username if it’s different

Edit file /etc/hosts

```
sudo nano /etc/hosts
```
Add the following lines:
```
127.0.0.1       testsite.test
```

Make sure that you can access the website from your web browser in the VM.

## Running PHP Unit tests

```
vendor/bin/phpunit
```

### Download and install chromedriver
v86 of Chromium comes with Ubuntu 16, so you should be downloading Chromedriver for Chrome version 86. Go to this [link](https://chromedriver.chromium.org/downloads) and download the file chromedriver_linux64.zip. Sample unzip instructions below:

```
cd ~/Downloads
unzip chromedriver_linux64.zip
sudo mv chromedriver /usr/local/bin
```
Open a new terminal windows and run chromedriver and leave it running in the background for behat testing.

```
cd ~
chromedriver
```

### Running behat tests

Due to a quirk unresolved at this point in time you need to run the behat tests from a copy of site.
Make sure you have chromedriver running on a seperate terminal window as above before continuing.

```
cd ~
sudo cp -a testsite testsite-copy
cd testsite-copy
SS_BASE_URL="http://testsite.test" php ./vendor/bin/behat --config=behat-local.yml
```

Any new phphunit and behat tests should be written in the testsite-copy folder. There is no need to copy the site folders over unless the codebase has changed.