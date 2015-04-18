## What is this?

This is our ( Team Open Source Consulting, Costa Rica ) entry for Bithack 2015 in Sunnyvale.   We've married Mario with Bitcoin.

At present the game is playable, but there are known bugs.  It's a novelty.

We are hosting a playable site for a short time only at http://mario.osc.co.cr for
purposes of the hackathon.

We intend to remove the site very soon, and also will immediately honor
any take-down requests made by copyright holder(s).

The following is our ChallengePost.com bithack entry text.


## Inspiration

Everyone knows Super Mario Bros and has collected thousands of coins playing it.  Our team at Open Source Consulting in Costa Rica thought it would be good clean fun to enhance the game with bitcoin so that every coin represents real value and can be collected when a level is completed.

For an extra level of silliness, we modified some of the images in the game to be familiar to bitcoin audiences.  Examples:
   coins = bitcoin image
   size-up mushroom = Tor Onion
   fireball flower = bitgo logo.
   level end flag = osc (our company) initials
   goomba enemy = Mark Karpeles
   cloud denizen = Dread Pirate Roberts
   breakable blocks = Butterfly labs logo.
   opening banner = Super Mario Bits  (instead of Bros)
   opening text = OSC BITHACK 2015

   I'm probably forgetting some!

## How it works

One of the neat things about this hack is that the player can begin playing immediately without knowing anything about bitcoin, and then can be brought into the fold after collecting coins and completing a level.  This is enabled by the ChangeTip tip-url API.

Our code modifies the original "Full Screen Mario" project to reset the coin count to zero each time a player dies or completes a level.

When a level completes, the coin count is sent to a super simple PHP server via AJAX.  The server interprets each coin as a penny.  It then makes a REST post to the ChangeTip Tip-URL API, passing in "X cents". ChangeTip returns a unique URL that the server returns to the browser and displayed to the user as an image in a graphical popup overlay that urges them to collect their earned coins.   At this point, the game is paused and the user has the opportunity to sign into changetip via social media and view that they have indeed received a payout.  This is amazing because it works even for brand new users.

## Challenges we ran into

First of all, there were no challenges with ChangeTip.  The API is super simple and easy to use, and worked flawlessly.    One suggestion we would make is to provide self-help for an access token with send permission, rather than requiring developers to send email request.   A second suggestion/request would be to provide a testing sandbox that uses the bitcoin testnet, so that developers do not need to use their hoarded/hodl'd bitcoin when testing apps!

We recognized that preventing cheating is a very hard problem because anyone can easily watch the AJAX calls to the server and fake them.  We decided to punt on this issue for the bithack as solving it is not core to the experience.  We do have a couple ideas how to do it fairly well, 

We had to figure out the image format used in the game's sprite library and how to generate images for it.  That was harder than it needed to be.

Most images in the game are only 16x16 pixels.  Making recognizable images at 16x16 pixels is a real challenge.
For the goomba character (replaced by image of Mark Karpeles) we wanted to make it 32x32, so this mean figuring out how to make the images larger and ensuring that collision detection continues to work correctly.

We ran into an issue with the interaction/flow between the end-of-level popup dialog and the pause/resume functionality of the game.  This sometime results in the dialog not appearing, or the screen remaining dim after unpausing.  This is an area that would need improving.

## Accomplishments that I'm proud of

That we came together as a team and had a good time creating this.

## What I learned

* That the ChangeTip API is super simple and a great conversion tool.

* that adding recognizable images to an NES game is really, really painful.

## What's next for SuperMarioBits

We don't intend to publicize SuperMarioBits as Nintendo already went after the original author of FullScreenMario.

However, we might "bitcoinify" some other public domain game for the lulz and to test out if there is any viable business model around this.
