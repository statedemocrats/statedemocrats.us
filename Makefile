all: build

install:
	cd .site && bundle install && cd ..

build:
	jekyll build --destination www --source .site

watch:
	jekyll build --destination www --source .site --watch

serve:
	cd .site && make serve

build-prod:
	JEKYLL_ENV=production jekyll build --destination www --source .site

deploy:
	ssh statedemocrats.us "bash --login -c 'cd /data/statedemocrats.us && git pull && make install build-prod'"

statedirs:
	ruby bin/mk-state-dirs

.PHONY: build all serve
