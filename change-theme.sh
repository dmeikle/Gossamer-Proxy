

mv ./web/assets/default ./web/assets/default-bak

mkdir ./web/assets/default
mkdir ./web/assets/default/images
mkdir ./web/assets/default/js
mkdir ./web/assets/default/css
mkdir ./web/assets/default/vt

cp -a ./src/themes/$1/images/. ./web/assets/default/images/
cp -a ./src/themes/$1/js/. ./web/assets/default/js/
cp -a ./src/themes/$1/css/. ./web/assets/default/css/
cp -a ./src/themes/$1/vt/. ./web/assets/default/vt/

#make sure the symlinks are there
ln -s ../../web/assets/default/images/ ./web/images/theme
ln -s ../../web/assets/default/js/ ./web/js/theme
ln -s ../../web/assets/default/css/ ./web/css/theme
ln -s ../../web/assets/default/vt/ ./web/vt/theme

