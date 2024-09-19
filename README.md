# Minecraft Multi Auth

Have multiple auth servers tested on login

## How to use

Use the url with what ever services, currently support here:

eg;

``http://minecraft-multi-auth.james090500.workers.dev/mojang/minehut`` would check mojang 1st then Minehut 2nd.

Velocity
```
-Dmojang.sessionserver=http://minecraft-multi-auth.james090500.workers.dev/mojang/minehut
```

Waterfall
```
-Dwaterfall.auth.url="<http://minecraft-multi-auth.james090500.workers.dev/mojang/minehut?username=%s&serverId=%s%s>"
```

Paper
```
-Dminecraft.api.auth.host=https://authserver.mojang.com/ -Dminecraft.api.account.host=https://api.mojang.com/ -Dminecraft.api.services.host=https://api.minecraftservices.com/ -Dminecraft.api.session.host=http://minecraft-multi-auth.james090500.workers.dev/mojang/minehut
```