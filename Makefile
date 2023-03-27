help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-24s\033[0m %s\n", $$1, $$2}'

all: build

install: ## Install .site gems
	cd .site && bundle install && cd ..

build: ## Build site
	jekyll build --destination www --source .site

watch: ## Run build and --watch
	jekyll build --destination www --source .site --watch

serve: ## Run make server in .site
	cd .site && make serve

build-prod: ## Build production-like site
	JEKYLL_ENV=production jekyll build --destination www --source .site

deploy: ## Deploy to production
	ssh statedemocrats.us "bash --login -c 'cd /data/statedemocrats.us && git pull && make install build-prod'"

statedirs: ## Build the state dirs
	ruby bin/mk-state-dirs

.PHONY: build all serve
