all: build

build:
	jekyll build --destination www --source .site

serve:
	jekyll serve --incremental

.PHONY: build all serve
