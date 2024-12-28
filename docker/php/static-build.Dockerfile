FROM --platform=linux/amd64 dunglas/frankenphp:static-builder
# ビルド時に必要なパッケージをインストール
RUN apk add --no-cache icu-dev

WORKDIR /go/src/app/dist/app
COPY . .

RUN rm -Rf tests/

RUN cp .env.example .env
RUN sed -i'' -e 's/^APP_ENV=.*/APP_ENV=production/' -e 's/^APP_DEBUG=.*/APP_DEBUG=false/' .env

RUN composer install --ignore-platform-reqs --no-dev -a

# ビルド時に必要なPHPの拡張機能を追加
ENV PHP_EXTENSIONS="intl,pdo_mysql,zip,bcmath,mbstring"

WORKDIR /go/src/app/
# 圧縮に1時間以上かかるため、圧縮を行わないようNO_COMPRESS=trueを指定。圧縮をしたいときはNO_COMPRESSを削除する
RUN NO_COMPRESS=true EMBED=dist/app/ ./build-static.sh
