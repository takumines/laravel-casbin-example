FROM --platform=linux/amd64 dunglas/frankenphp:static-builder

RUN apk add --no-cache icu-dev

# Copy your app
WORKDIR /go/src/app/dist/app
COPY . .

# Remove the tests and other unneeded files to save space
# Alternatively, add these files to a .dockerignore file
RUN rm -Rf tests/

# Copy .env file
RUN cp .env.example .env
# Change APP_ENV and APP_DEBUG to be production ready
RUN sed -i'' -e 's/^APP_ENV=.*/APP_ENV=production/' -e 's/^APP_DEBUG=.*/APP_DEBUG=false/' .env

# Install the dependencies
RUN composer install --ignore-platform-reqs --no-dev -a

ENV PHP_EXTENSIONS="intl,pdo_mysql,zip,bcmath,mbstring"

# Build the static binary
WORKDIR /go/src/app/
RUN NO_COMPRESS=true EMBED=dist/app/ ./build-static.sh