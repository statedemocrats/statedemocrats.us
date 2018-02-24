all: build

build:
	jekyll build --destination www --source .site

serve:
	jekyll serve --incremental

deploy:
	ssh statedemocrats.us 'cd /data/statedemocrats.us && git pull && make build'

.PHONY: build all serve
