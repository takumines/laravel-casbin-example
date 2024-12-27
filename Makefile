#-----------------------------------------------------------
# general
#-----------------------------------------------------------

init: ## 初期設定
	@make build
	@make up
	docker compose exec php cp .env.example .env
	docker compose exec php composer install
	docker compose exec php php artisan key:generate
	docker compose exec php chmod -R 777 storage bootstrap/cache
	@make fresh

build: ## コンテナをビルドする
	docker compose build

up: ## コンテナを起動する
	docker compose up -d

stop: ## コンテナを停止する
	docker compose stop

down: ## コンテナを停止して削除する
	docker compose down --remove-orphans

down-v: ## コンテナを停止して削除する（ボリュームも削除）
	docker compose down --remove-orphans --volumes

ps: ## コンテナの状態を表示する
	docker compose ps

logs: ## ログを表示する
	docker compose logs

logs-watch: ## ログを表示する（リアルタイム）
	docker compose logs --follow

#-----------------------------------------------------------
# laravel
#-----------------------------------------------------------
migrate: ## マイグレーションを実行する
	docker compose exec php php artisan migrate

seed: ## シーダーを実行する
	docker compose exec php php artisan db:seed

fresh: ## マイグレーションをリセットして実行する
	docker compose exec php php artisan migrate:fresh --seed

tinker: ## Tinker（REPL）を起動する
	docker compose exec php php artisan tinker