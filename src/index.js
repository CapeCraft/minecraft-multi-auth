const authUrls = {
	"mojang": "https://sessionserver.mojang.com/session/minecraft/hasJoined",
	"minehut": "https://api.minehut.com/mitm/proxy/session/minecraft/hasJoined"
};


export default {
	async fetch(request, env, ctx) {
		// Set base varialbes
		const url = new URL(request.url);
		const pathname = url.pathname;

		// Prep the path
		const authServices = pathname
			.replace('session/minecraft/hasJoined', '')
			.replace('//', '')
			.substring(1)
			.split('/')
			.filter(n => n)

		// If no params
		// or more than 2 services to protect CPU time
		if(!url.search || authServices > 5) {
			return Response.redirect("https://github.com/CapeCraft/minecraft-multi-auth", 302);
		}

		// Loop through services
		for(const authService of authServices) {
			// Get the auth URL
			const authUrl = authUrls[authService];

			// Check the url contains a valid service
			if (!authUrl) continue;

			// Get the auth url for authentication
			const modifiedUrl = authUrl + url.search;

			// Send modified request
			const modifiedRequest = new Request(modifiedUrl);
			const response = await fetch(modifiedRequest);

			// If the response is not valid, loop to the next
			if (response.status != 200) continue;

			return response;
		}

		// If no valid response, fail
		return new Response(null, {status: 204});
	},
};
