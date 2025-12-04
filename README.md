# Deprecated 2025 in favour of https://github.com/capecraft/minegate

# Minecraft Multi Auth

Have multiple auth servers tested on login

## How to use

Use the url with what ever services, currently support here:

eg;

``https://mcauth.james090500.com/mojang/minehut/mojang/minehut`` would check mojang 1st then Minehut 2nd.

Velocity
```
-Dmojang.sessionserver=https://mcauth.james090500.com/mojang/minehut/mojang/minehut
```

Waterfall
```
-Dwaterfall.auth.url="<https://mcauth.james090500.com/mojang/minehut/mojang/minehut?username=%s&serverId=%s%s>"
```

Paper
```
-Dminecraft.api.auth.host=https://authserver.mojang.com/ -Dminecraft.api.account.host=https://api.mojang.com/ -Dminecraft.api.services.host=https://api.minecraftservices.com/ -Dminecraft.api.session.host=https://mcauth.james090500.com/mojang/minehut/mojang/minehut
```
