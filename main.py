import requests
import discord
from discord.ext import commands
from discord import file
from discord.utils import get
import os

client = commands.Bot(command_prefix='+', help_command=None)

@client.command()
@commands.dm_only()
async def setup(ctx):
    
    guild = client.get_guild(Server_ID)
    
    member = await guild.fetch_member(ctx.author.id)
    
    role_id = Buyer_Role_ID

    if any(role.id == role_id for role in member.roles):
        giveaway_questions = ['What Is The Game ID?', 'Give Me The Visit Webhook', 'Give Me The NBC Webhook', 'Give Me The Premium Webhook', 'Give Me The Success Webhook', 'Give Me The Failed Webhook']
        giveaway_answers = []

        def check(m):
            return m.author == ctx.author and m.channel == ctx.channel
    
        for question in giveaway_questions:
            message = (f"{question}")
            embedVar = discord.Embed(title=message, color=0x0000FF)
            await ctx.send(embed=embedVar)
            try:
                message = await client.wait_for('message', timeout= 300.0, check= check)
            except asyncio.TimeoutError:
                message = (f"Error")
                embedVar = discord.Embed(title=message, color=0xFF0000)
                await ctx.send(embed=embedVar)
                return
            else:
                giveaway_answers.append(message.content)
        gameID = (giveaway_answers[0])
        visit = (giveaway_answers[1])
        nbc = (giveaway_answers[2])
        premium = (giveaway_answers[3])
        success = (giveaway_answers[4])
        failed = (giveaway_answers[5])

        discID = ctx.author.id

        embedVar = discord.Embed(title="Config Info", description="**Please Check If Everything Is Correct**", color=0x0000FF)
        embedVar.add_field(name="Game ID", value=f"```{gameID}```", inline=False)
        embedVar.add_field(name="Visit Webhook", value=f"```{visit}```", inline=False)
        embedVar.add_field(name="NBC Webhook", value=f"```{nbc}```", inline=False)
        embedVar.add_field(name="Premium Webhook", value=f"```{premium}```", inline=False)
        embedVar.add_field(name="Success Webhook", value=f"```{success}```", inline=False)
        embedVar.add_field(name="Failed Webhook", value=f"```{failed}```", inline=False)

        await ctx.send(embed=embedVar, delete_after=5)
    
        api = requests.get(f"website_link_here/updateWebhooks.php?game={gameID}&success={success}&premium={premium}&visit={visit}&failed={failed}&nbc={nbc}&disc={discID}")

        apiCheck = api.text
    
        if apiCheck == 'Listed':
                message2 = (f"Successfully Listed!")
                embedVar2 = discord.Embed(title=message2, color=0x0000FF)
        elif apiCheck == 'Updated':
                message2 = (f"Successfully Updated!")
                embedVar2 = discord.Embed(title=message2, color=0x0000FF)
        await ctx.send(embed=embedVar2)
        await sChannel.send(embed=embed)
    else:
        await ctx.reply("**Error**")
        await sChannel.send(embed=embed)
        
@client.event
async def on_ready():
    await client.change_presence(activity=discord.Game('© YuvalServices'))
    print('Logged in as')
    print(client.user.name)
    print(client.user.id)
    print('------')

@client.event
async def on_command_error(ctx, error):
    if isinstance(error, commands.CommandOnCooldown):
        message = (f"You Can Use This Command Again In **{round(error.retry_after, 2)}** Seconds!")
        embedVar = discord.Embed(title=message, color=0xFF0000)
        await ctx.channel.send(embed=embedVar)
    elif isinstance(error, commands.MissingRequiredArgument):
        message = (f"Missing Argument!")
        embedVar = discord.Embed(title=message, color=0xFF0000)
        await ctx.channel.send(embed=embedVar)
    elif isinstance(error, (commands.MissingRole, commands.MissingAnyRole)):
        message = (f"Not Enough Permission")
        embedVar = discord.Embed(title=message, color=0xFF0000)
        await ctx.channel.send(embed=embedVar)
    elif isinstance(error, commands.CommandNotFound):
        message = (f"Command Missing")
        embedVar = discord.Embed(title=message, color=0xFF0000)
        await ctx.channel.send(embed=embedVar)
    elif isinstance(error, commands.PrivateMessageOnly):
        message = (f"DM Me This Command!")
        embedVar = discord.Embed(title=message, color=0xFF0000)
        await ctx.channel.send(embed=embedVar)
       
client.run(os.environ['MTE2NzcxNTU2MjUxMjcxOTkzMg.G8gFG3._Uz0uDrn6Zfd3h76ThcVFQAsznKvewB5BhQaac'])
