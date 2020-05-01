@extends('layouts.app')

@section('content')


<div class="container mx-auto">

    <div>
        <h2 class="text-2xl">Fashion Guide </h2>
        <p class="mb-3">This is a guide written to help people get into fashion reps. This guide with include:</p>
    </div>


    <ul class="list-insid list-disc">
        <li>Fashion rep terms</li>
        <li>Where to buy reps</li>
        <li>What an agent is and how to use them</li>
        <li>How sizing works</li>
        <li>Shipping</li>
    </ul>

    <div>
        <h1 class="text-xl underline pt-3">Fashion Rep terms</h1>
        <p>Here are some terms that you will want to familiarize yourself with.</p>
        <ul class="list-insid list-decimal ">
            <li class="pb-3"><span class="font-bold">QC (Quality Control):</span> These are pictures you get from your
                agent of the item that you ordered. People wil post these online to the <a
                    class="text-indigo-600 hover:text-indigo-800 underline" href="https://www.reddit.com/r/FashionReps"
                    target="_blank">Fashion Reps subreddit</a> if they are unsure of the quality of the item or just
                want a second opinion.</li>
            <li class="pb-3"><span class="font-bold">LC (Legit Check):</span> Legit checks are for finding out whether
                the item you are purchasing is authentic or not.</li>
            <li class="pb-3"><span class="font-bold">GP (Guinea Pig):</span> Guinea Pigging is like being the test
                subject. When someone says they are going to GP something it means they will be the first person to
                order a sellers new item.</li>
            <li class="pb-3"><span class="font-bold">FIND:</span> Finds are mostly linked to new items that haven't been
                posted before.</li>
            <li class="pb-3"><span class="font-bold">1:1 (One to One):</span> 1:1 refers to a perfect replica. These are
                hard to get becasue sellers sell out fast.</li>
            <li class="pb-3"><span class="font-bold text-green-500">GL (Green Light):</span> This is used as approval
                for someone's QC check and the person should ship their item.</li>
            <li class="pb-3"><span class="font-bold text-red-500">RL (Red Light):</span> This is used as disapproval for
                someone's QC check. The item in the QC pictures most likely has defects or something wrong with it and
                the buyer should not ship the item however, they still can if they are okay with the defects.</li>
            <li class="pb-3"><span class="font-bold">B&S (Bait and Switch):</span> Refers to a seller who has advertised
                their product and sent a different item from advertised.</li>
        </ul>
    </div>

    <h1 class="text-xl underline pt-3">Where can I buy reps?</h1>
    <p>There are many different ways to buy reps we have gathered some websites for you to use. CNFashionBuy has a
        navigation for sellers, different categories, filters, etc and is probably the easiest to use for beginners.
    </p>
    <ul class="list-insid list-disc">
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href="https://weidian.com/"
                target="_blank">Weidian</a>: Similar to Taobao, you can find budget batches here.</li>
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href="https://www.taobao.com/"
                target="_blank">Taobao</a>: Can be quite tricky to use but it is well worth it and where you will find a
            lot of your reps.</li>
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href="http://www.dhgate.com/"
                target="_blank">DHgate</a>: A good option if you only want to buy one thing. Has less hype items like
            Nike running shoes.</li>
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href="https://www.cnfashionbuy.net/"
                target="_blank">CNFashionBuy</a>: Easy website to use for buying reps from different known sellers.</li>
    </ul>
    <p>You might have noticed that the pages are in Chinese this is okay as Google Chrome has a built in translator. To
        translate the page just right click and click "Translate this page" and you'll be gucci.</p>

    <h1 class="text-xl underline pt-3">Using an agent</h1>
    <p>You are probably wondering what an agent is well an agent is a third party with a warehouse. The agent will order
        your items from Taobao, Weidian, DHgate, etc the agent will then repackage your items into one package and ship
        it to you using EMS, DHL, or China Post more on this later.</p>
    <ul class="list-insid list-decimal">
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href=" https://www.wegobuy.com/en/"
                target="_blank">Wegobuy</a>
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href=" https://www.cssbuy.com/"
                target="_blank">Cssbuy</a>
        <li class="pb-3"><a class="text-indigo-600 hover:text-indigo-800 underline" href=" https://www.superbuy.com/en/"
                target="_blank">Superbuy</a>
    </ul>
    <p>These agents have different fees for your items so you should see what is the best one for you. Wegobuy seems to
        be the most popular right now for reps and is basically the same thing as Superbuy.</p>

    <h1 class="text-xl underline pt-3">How do I know what size to buy?</h1>
    <p>This is a VERY important question. Some products will be reproduced with the same
        original size designations. Others will be shifted to better accommodate their Asian clients. Some items
        purchased from TaoBao could be a Large that fits like a US XS. So you really need to pay attention.</p>
    <p>When you find a piece you like, it's time to pick the correct size. Most of the
        time, sellers will have a size chart towards the bottom of the item page. You'll have to scroll down a bit to
        find it.</p>
    <div>Here are the translations for sizing:</div>
    <p><span class="text-bold">肩宽</span> - Shoulder Width</p>
    <p><span class="text-bold">胸围</span> - Bust/Chest Width</p>
    <p><span class="text-bold">衣长</span> - Length</p>
    <p>The surefire way of picking the correct size is to identify the type of item
        you're purchasing (shirt, coat, pants, underwear) and measure an item of that type you own. So, if I wanted to
        buy a bogo tee, and I didn't know my size, I'd take a shirt that fits me, and measure from shoulder seam to
        shoulder seam for shoulder width, pit to pit for bust then x2, and bottom of collar to the bottom for the
        length.</p>
    <p>The reason you multiply the bust by 2 is because some sellers will have chest
        circumference listed on their chart, so to get your chest circumference just measure pit to pit and x2.</p>

    <h1 class="text-xl underline pt-3">How does shipping work?</h1>
    <p>There are a couple of different shopping options that you can use to ship your items we will list them and then
        you can pick which to choose based on where you live. Shipping works a bit differently than you're probably used
        to. You will pay a
        small fee (5-10yuan) for shipping when you first order the item. Then, once your agent has all the items and
        weighs them, you will pay them for the final shipment of everything from them to you. It is not uncommon for a
        $150 haul to cost $50 to ship. Keep this in mind when you are budgeting your order.
    </p>
    <ul class="list-insid list-disc">
        <li class="pb-3 pt-2">EMS: Fast shipping times around ten business days. EMS is great for buyers from the United
            States.</li>
        <li class="pb-3">DHL: Fast shipping times around seven business days. DHL is great for buyers from the EU as it
            has less
            seizure rates from customs. The good thing about DHL is that US buyers can use this shipping method.</li>
        <li class="pb-3">China Post: Slow shipping times around thirty business days. You should only use China Post if
            you want to
            ship at a low price and are fine with your items taking a while to arrive.</li>
    </ul>

</div>

@endsection
