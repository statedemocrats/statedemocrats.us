all: build

build:
	cd .site && bundle install && cd ..
	jekyll build --destination www --source .site

serve:
	jekyll serve --incremental

deploy:
	ssh statedemocrats.us "bash --login -c 'cd /data/statedemocrats.us && git pull && make build'"

.PHONY: build all serve
