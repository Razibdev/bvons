module.exports = {
	globDirectory: 'public/',
	globPatterns: [
		'**/*.{js,png,jpeg,docx,css,jpg,eot,ttf,woff,woff2,svg,ico,otf,gif,lnk,webp,php,txt,json,md,html,fla,swf,ts,rb,less,scss,zip,xml,PNG,mp4}'
	],
	swDest: 'workbox generateSW',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};