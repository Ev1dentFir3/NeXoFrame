<?php
  header("Content-type: text/javascript; charset: UTF-8");
  include_once '../includes/userdata/config.php';
  include_once '../includes/languages/'.$lang.'.php';
?>
/* commit 132 */

/* globals $, moment, Cookies */

let worldState;
let updateTime;
let platformSwapped = false;

// Cetus timer stuff
let cetusIsDay;
let cetusCurrentTitle;
let cetusCurrentTitleTimezone;
let cetusCurrentIndicator;
let cetusCurrentIndicatorColor;

// Earth timer stuff
let earthIsDay;
let earthCurrentTitle;
let earthCurrentTitleTimezone;
let earthCurrentIndicator;
let earthCurrentIndicatorColor;

// NeXoFrame functions
$('#worldstateTabs li').on('click', function(){
  $(this).siblings().removeClass('active')
  $(this).addClass('active');
})

function wsHideAll() {
  $('#alertContainer, #invasionContainer, #syndicateContainer, #fissureContainer, #sortieContainer, #conclaveContainer, #conclaveMissionContainer, #bountyContainer, #voidTraderContainer, #acolyteContainer, #eventContainer').css("display", "none");
}
$('#alertIcon').on('click', function() {
  wsHideAll();
  $('#alertContainer').css("display", "block");
})
$('#invasionIcon').on('click', function() {
  wsHideAll();
  $('#invasionContainer').css("display", "block");
})
$('#syndicateIcon').on('click', function() {
  wsHideAll();
  $('#syndicateContainer').css("display", "block");
})
$('#fissureIcon').on('click', function() {
  wsHideAll();
  $('#fissureContainer').css("display", "block");
})
$('#sortieIcon').on('click', function() {
  wsHideAll();
  $('#sortieContainer').css("display", "block");
})
$('#conclaveIcon').on('click', function() {
  wsHideAll();
  $('#conclaveContainer').css("display", "block");
})
$('#conclaveMissionIcon').on('click', function() {
  wsHideAll();
  $('#conclaveMissionContainer').css("display", "block");
})
$('#bountyIcon').on('click', function() {
  wsHideAll();
  $('#bountyContainer').css("display", "block");
})
$('#voidTraderIcon').on('click', function() {
  wsHideAll();
  $('#voidTraderContainer').css("display", "block");
})
$('#acolyteIcon').on('click', function() {
  wsHideAll();
  $('#acolyteContainer').css("display", "block");
})
$('#eventIcon').on('click', function() {
  wsHideAll();
  $('#eventContainer').css("display", "block");
})

$(window).scroll(function() {
  var x = $(this).scrollTop();
  $('.wsBody').css('background-position','100% '+parseInt(-x/5)+'px, center top');
})

function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Update worldstate timestamp
function updateWorldStateTime() {
  if (document.getElementById('worldstateinfo')) {
    document.getElementById('worldstateinfo').setAttribute('data-original-title', `World State for ${
      Cookies.get('platform')} updated at ${moment(updateTime).format('MMMM Do YYYY, h:mm:ss a')}`);
  }
}

// Helper function to display duration in human readable format, short version
function formatDurationShort(duration) {
  let timeText = '';
  if (duration.days()) {
    timeText += `${duration.days()}d ${duration.hours()}h ${duration.minutes()}m ${duration.seconds()}s`;
  } else if (duration.hours()) {
    timeText += `${duration.hours()}h ${duration.minutes()}m ${duration.seconds()}s`;
  } else if (duration.minutes()) {
    timeText += `${duration.minutes()}m ${duration.seconds()}s`;
  } else {
    timeText += `${duration.seconds()}s`;
  }
  return timeText;
}

// Helper function to grab objects based on inner tags
function getObjects(obj, key, val) {
  let objects = [];
  if (typeof obj !== 'undefined') {
    for (const objKey of Object.keys(obj)) {
      if (typeof obj[objKey] === 'object') {
        objects = objects.concat(getObjects(obj[objKey], key, val));
      } else if (objKey === key && obj[objKey] === val) {
        objects.push(obj);
      }
    }
  }
  return objects;
}

// Update data that is being used by this page
function updateDataDependencies() {
  cetusIsDay = worldState.cetusCycle.isDay;
  earthIsDay = worldState.earthCycle.isDay;
}

function updateEarthTitle() {
  if (!earthIsDay) {
    earthCurrentIndicator = 'Night';
    earthCurrentIndicatorColor = 'darkblue';
    earthCurrentTitle = 'Time until day: ';
    earthCurrentTitleTimezone = 'Time at day: ';
  } else {
    earthCurrentIndicator = 'Day';
    earthCurrentIndicatorColor = 'orange';
    earthCurrentTitle = 'Time until night: ';
    earthCurrentTitleTimezone = 'Time at night: ';
  }
}

function updateEvents() {
  const {events} = worldState;
  if (platformSwapped && document.getElementById('component-event-body')) {
    $('#component-event-body li').slice(1).remove();
  }
  if (events.length) {
    const componentBody = $('#component-event-body');
    events.forEach((event, index) => {
      let title;
      let body = event.tooltip ? `<div class="text-center">${event.tooltip}</div><br />` : '';
      if ($(`#event-${event.id}-title`).length === 0) {
        if (index === 0) {
          title = `<h2 class="display-3 text-center">${event.description}</h2>`;
        } else {
          title = `<p class="text-center">${event.description}</p>`;
        }
        body += `<div class="text-center d-inline"><span class="label label-danger ">${event.victimNode}</span><span>${event.health || 0}% Remaining</span></div><br />`;
        if (event.jobs) {
          let listItems = '<div class="container-fluid">';
          event.jobs.forEach(job => {
            const standingPanelHeading = `<div class="panel-heading text-center"><h3 class="panel-title"><a href="#standingPanelBody${job.id}" data-toggle="collapse">Standing<span class="glyphicon glyphicon-triangle-bottom pull-right"></span></a></h3></div>`;
            const standingTableBody = `<tbody>${job.standingStages.map(stage => `<tr class="text-center"><td>${stage}</tr></td>`).join('')}</tbody>`;
            const standingTable = `<table class="table List" style="table-layout: fixed" id="${job.id}">${standingTableBody}</table>`;
            const standingPanelBody = `<div class="panel-body collapse" id="standingPanelBody${job.id}" style="padding-top:0; padding-bottom:0;">${standingTable}</div>`;

            let standingPanelWrapper;
            standingPanelWrapper = `<div class="panel panel-primary" style="margin-left:5%; margin-right:5%" id="${job.id}StandingPanel">`;
            standingPanelWrapper += standingPanelHeading;
            standingPanelWrapper += standingPanelBody;
            standingPanelWrapper += '</div>';

            const rewardPanelHeading = `<div class="panel-heading text-center"><h3 class="panel-title"><a href="#rewardsPanelBody${job.id}" data-toggle="collapse">Rewards<span class="glyphicon glyphicon-triangle-bottom pull-right"></span></a></h3></div>`;
            const rewardTableBody = `<tbody>${job.rewardPool.map(reward => `<tr class="text-center"><td>${reward}</tr></td>`).join('')}</tbody>`;
            const rewardTable = `<table class="table List" style="table-layout: fixed" id="${job.id}">${rewardTableBody}</table>`;
            const rewardPanelBody = `<div class="panel-body collapse" id="rewardsPanelBody${job.id}" style="padding-top:0; padding-bottom:0;">${rewardTable}</div>`;

            let rewardPanelWrapper;
            rewardPanelWrapper = `<div class="panel panel-primary" style="margin-left:5%; margin-right:5%" id="${job.id}RewardsPanel">`;
            rewardPanelWrapper += rewardPanelHeading;
            rewardPanelWrapper += rewardPanelBody;
            rewardPanelWrapper += '</div>';

            const jobTitle = `<div class="col-md-6"><div class="col-md-7 col-sm-offset-3"><span class="label label-primary pull-right">${job.enemyLevels.join(' - ')}</span><span style="padding-right:5px;">${job.type}<span></div>`;
            let jobBody = '<br />';
            jobBody += `<div class="col-md-7 col-md-offset-3">${standingPanelWrapper}</div>`;
            jobBody += `<div class="col-md-7 col-md-offset-3">${rewardPanelWrapper}</div>`;
            jobBody += '</div>';
            listItems += `${jobTitle}${jobBody}`;
          });
          body += `${listItems}</div>`;
        }
        if (title && body) {
          componentBody.append(`<li id="event-${event.id}-title">${title}${body}</li>`);
        }
      } else if (event.expired) {
        $(`#event-${event.id}-title"`).remove();
      }
    });
    $('#event-title').hide();
    if (Cookies.get('event') === 'true') {
      $('#component-event').show();
    }
  } else {
    $('#event-title').hide();
    $('#component-event').hide();
  }
}

function updateCetusTitle() {
  if (!cetusIsDay) {
    cetusCurrentIndicator = 'Night';
    cetusCurrentIndicatorColor = 'darkblue';
    cetusCurrentTitle = 'Time until day: ';
    cetusCurrentTitleTimezone = 'Time at day: ';
  } else {
    cetusCurrentIndicator = 'Day';
    cetusCurrentIndicatorColor = 'orange';
    cetusCurrentTitle = 'Time until night: ';
    cetusCurrentTitleTimezone = 'Time at night: ';
  }
}

function updateCetusCycle() {
  let expiryTime = moment(worldState.cetusCycle.expiry).unix();
  const currentTime = moment().unix();

  // Oh no, cycle expired before we can fetch a new one
  if (currentTime > expiryTime) {
    cetusIsDay = !cetusIsDay;
    if (cetusIsDay) {
      expiryTime = moment(worldState.cetusCycle.expiry).add(100, 'm').unix(); // Add 100 min for day, temporarily
    } else {
      expiryTime = moment(worldState.cetusCycle.expiry).add(50, 'm').unix(); // Add 50 min for night, temporarily
    }
  }

  updateCetusTitle();

  const cycleIndicator = $('#cetuscycleindicator');
  cycleIndicator.html(cetusCurrentIndicator);
  if (!cycleIndicator.hasClass(cetusCurrentIndicatorColor)) {
    cycleIndicator.attr('class', cetusCurrentIndicatorColor);
    cycleIndicator.addClass('pull-right');
  }

  $('#cetuscycletitle').html(cetusCurrentTitle);
  $('#cetustimezonetitle').html(cetusCurrentTitleTimezone);
  $('#cetustimezonetime').html(moment.unix(expiryTime).format('h:mm:ss a, MM/DD/YYYY'));

  const timeBadge = $('#cetuscycletime');
  timeBadge.attr('data-endtime', expiryTime);
  timeBadge.addClass('label timer');
}

function updateEarthCycle() {
  let expiryTime = moment(worldState.earthCycle.expiry).unix();
  const currentTime = moment().unix();

  // Oh no, cycle expired before we can fetch a new one
  if (currentTime > expiryTime) {
    cetusIsDay = !cetusIsDay;
    expiryTime = moment(worldState.earthCycle.expiry).add(4, 'h').unix(); // Add 4hrs, temporarily
  }

  updateEarthTitle();

  const cycleIndicator = $('#earthcycleindicator');
  cycleIndicator.html(earthCurrentIndicator);
  if (!cycleIndicator.hasClass(earthCurrentIndicatorColor)) {
    cycleIndicator.attr('class', earthCurrentIndicatorColor);
    cycleIndicator.addClass('pull-right');
  }

  $('#earthcycletitle').html(earthCurrentTitle);
  $('#earthtimezonetitle').html(earthCurrentTitleTimezone);
  $('#earthtimezonetime').html(moment.unix(expiryTime).format('h:mm:ss a, MM/DD/YYYY'));

  const timeBadge = $('#earthcycletime');
  timeBadge.attr('data-endtime', expiryTime);
  timeBadge.addClass('label timer');
}

function updateCetusBountyTimer() {
  const cetusBlock = getObjects(worldState, 'syndicate', 'Ostrons');
  if (cetusBlock !== null && cetusBlock[0]) {
    const cetus = cetusBlock[0];

    const expiryTime = moment(cetus.expiry).unix();
    const activateTime = moment(cetus.activation).unix();
    const currentTime = moment().unix();

    if (currentTime < activateTime) {
      $('#cetusbountytitle').html('New bounties in:');
      const timeBadge = $('#cetusbountytime');
      timeBadge.attr('data-endtime', activateTime);
      timeBadge.addClass('label timer');
      timeBadge.show();
    } else if (currentTime > activateTime && currentTime < expiryTime) {
      $('#cetusbountytitle').html('Bounties expire in:');
      const timeBadge = $('#cetusbountytime');
      timeBadge.attr('data-endtime', expiryTime);
      timeBadge.addClass('label timer');
      timeBadge.show();
    } else {
      $('#cetusbountytitle').html('Bounties expired, waiting for update...');
      const timeBadge = $('#cetusbountytime');
      timeBadge.removeClass('label timer');
      timeBadge.hide();
    }
  } else {
    $('#cetusbountytitle').html('No bounty information, waiting for update...');
    const timeBadge = $('#cetusbountytime');
    timeBadge.removeClass('label timer');
    timeBadge.hide();
  }
}

function updateVoidTraderInventory() {
  const voidTraderInventory = worldState.voidTrader.inventory;
  if (voidTraderInventory.length !== 0) {
    if (document.getElementById(worldState.voidTrader.id) === null) {
      if (platformSwapped && document.getElementsByClassName('voidTraderInventory')) {
        $('.voidTraderInventory').remove();
      }
      /* eslint-disable prefer-template */
      const inventoryString = `${'<div class="panel panel-primary voidTraderInventory" ' +
                'style="margin-left:5%; margin-right:5%" ' +
                'id="'}${worldState.voidTrader.id}">\n<div class="panel-heading">\n` +
                `<h3 class="panel-title">${worldState.voidTrader.character} Inventory` +
                '<a href="#voidTraderInventoryPanel" data-toggle="collapse">' +
                '<span class="glyphicon glyphicon-triangle-bottom pull-right"></span></a></h3>\n' +
                '</div>\n' +
                '<div class="panel-body collapse" id="voidTraderInventoryPanel">\n' +
                '<table class="table table-striped table-hover ">\n' +
                '<thead>\n' +
                '<tr>\n' +
                '<th class="text-center">Item Name</th>\n' +
                '<th class="text-center">Ducats</th>\n' +
                '<th class="text-center">Credits</th>\n' +
                '</tr>\n' +
                '</thead>\n' +
                '<tbody id="voidTraderInventoryContent">\n' +
                '</tbody>\n' +
                '</table>\n' +
                '</div>\n' +
                '</div>';
      /* eslint-enable prefer-template */
      const elementBody = $('#voidTraderBody');
      elementBody.append(inventoryString);
      elementBody.show();
      for (const currentItem of voidTraderInventory) {
        const itemString = `<tr><td>${currentItem.item}</td>` +
                  `<td>${currentItem.ducats}</td><td>${currentItem.credits}</td></tr>`;
        $('#voidTraderInventoryContent').append(itemString);
      }
    }
  } else if (document.getElementsByClassName('voidTraderInventory')) {
    $('.voidTraderInventory').remove();
  }
}

function updateVoidTrader() {
  const {voidTrader} = worldState;
  if (voidTrader) {
    const expiryTime = moment(voidTrader.expiry).unix();
    const activateTime = moment(voidTrader.activation).unix();
    const currentTime = moment().unix();

    if (currentTime < activateTime) {
      $('#voidtradertitle').html(`${voidTrader.character} arrives in:`);
      $('#voidtradertimezonetitle').html('Arrives at:');
      $('#voidtradertimezonetime').html(moment.unix(activateTime).format('h:mm:ss a, MM/DD/YYYY'));

      const timeBadge = $('#voidtradertime');
      timeBadge.attr('data-endtime', activateTime);
      timeBadge.addClass('label timer');
      timeBadge.show();
    } else if (currentTime > activateTime && currentTime < expiryTime) {
      $('#voidtradertitle').html(`${voidTrader.character} leaves in:`);
      $('#voidtradertimezonetitle').html('Leaves at:');
      $('#voidtradertimezonetime').html(moment.unix(expiryTime).format('h:mm:ss a, MM/DD/YYYY'));

      const timeBadge = $('#voidtradertime');
      timeBadge.attr('data-endtime', expiryTime);
      timeBadge.addClass('label timer');
      timeBadge.show();
    } else {
      $('#voidtradertitle').html('Void Trader expired, waiting for update...');
      $('#voidtradertimezonetitle').html('');
      $('#voidtradertimezonetime').html('');

      const timeBadge = $('#voidtradertime');
      timeBadge.removeClass('label timer');
      timeBadge.hide();
    }
  } else {
    $('#voidtradertitle').html('No Void Trader available, waiting for update...');
    $('#voidtradertimezonetitle').html('');
    $('#voidtradertimezonetime').html('');

    const timeBadge = $('#voidtradertime');
    timeBadge.removeClass('label timer');
    timeBadge.hide();
  }
}

function calculateInventory(total, sold) {
  return `${total - sold}/${total}`;
}

const cleanupDailyDeals = dailyDeals => {
  if (platformSwapped && document.getElementsByClassName('dailyDealsInventory')) {
    $('.dailyDealsInventory').remove();
  } else if ($('.dailyDealsInventory').attr('id') !== dailyDeals[0].id) {
    $('.dailyDealsInventory').remove();
  }
};

function updateDarvoDeals() {
  const {dailyDeals} = worldState;
  if (dailyDeals.length !== 0) {
    $('#darvotitle').hide();
    if (document.getElementById(dailyDeals[0].id) === null) {
      cleanupDailyDeals(dailyDeals);

      const inventoryString = `<table class="dailyDealsInventory" id="${
        dailyDeals[0].id}">\n` +
                '<thead>\n' +
                '<th colspan="5"><h3>Darvo Deal</h3></th>' +
                '</thead>\n' +
                '<tbody>\n' +
                '<th>Item</th>' +
                '<th>Time Left</th>' +
                '<th>Discount</th>' +
                '<th>Price</th>' +
                '<th>Inventory</th>' +
                '<tr id="dailyDealsInventory">\n' +
                '</tbody>\n' +
                '</table>';
      $('#darvobody').append(inventoryString);

      for (const currentItem of dailyDeals) {
        const itemString = `<td>${currentItem.item}</td><td style="padding-right:0;"><span class="label timer pull-right" data-endtime="${moment(currentItem.expiry).unix()}"></span></td><td>${currentItem.discount}%</td><td>${currentItem.salePrice} <img src="img/general/plat.png" class="plat" /></td>` +
                           `<td>${calculateInventory(currentItem.total, currentItem.sold)}</td>`;
        $('#dailyDealsInventory').append(itemString);
      }
    }
  } else if (document.getElementsByClassName('dailyDealsInventory')) {
    $('.dailyDealsInventory').remove();
    document.getElementById('darvotitle').innerText = 'No current deals';
    $('#darvotitle').show();
  }
}

const cleanupDeals = dailyDeals => {
  if (platformSwapped && document.getElementsByClassName('dealsInventory')) {
    $('.dealsInventory').remove();
  } else if ($('.dealsInventory').attr('id') !== dailyDeals[0].id) {
    $('.dealsInventory').remove();
  }
};

function updateAcolytes() {
  const {persistentEnemies} = worldState;
  if (persistentEnemies.length !== 0) {
    $('#acolytetitle').hide();
    if (platformSwapped && document.getElementById('alertContainer')) {
      $('#acolyteList').children().not('#acolytebody').remove();
    }

    if (document.getElementById('acolyteList').children.length >= 1) {
      for (const acolyte of persistentEnemies) {
        if ($(`#${acolyte.id}`).length === 0) {
          const lastDiscoveredTime = moment(acolyte.lastDiscoveredTime).unix();
          let acolyteRow = `<li id="${acolyte.id}">`;
          acolyteRow += `<b>${acolyte.agentType}</b>`;
          acolyteRow += `<br><div style="margin-top:2px"><b>${acolyte.isDiscovered ? '' : 'Last '} At ${acolyte.lastDiscoveredAt}</b>` +
                        ` | <b>Level: </b>${acolyte.rank}` +
                        ` <span class="label label-primary pull-right" id="${acolyte.id}-lastDiscoveredTime">${moment.unix(lastDiscoveredTime).format('h:mm:ss a, MM/DD/YYYY')}</span>`;

          const remainingBar = $(`#${acolyte.id}_progress`).children()[0];
          const progressBar = $(`#${acolyte.id}_progress`).children()[1];

          if (acolyte.count > 0) {
            $(remainingBar).addClass('winning-right');
            $(progressBar).removeClass('winning-left');
          } else {
            $(remainingBar).removeClass('winning-right');
            $(progressBar).addClass('winning-left');
          }

          const remainingPercent = Math.floor(parseInt(acolyte.healthPercent * 100, 10));
          const progressPercent = 100 - remainingPercent;

          const remainingLabel = `<span id="${acolyte.id}-health">${(acolyte.healthPercent * 100).toFixed(2)}% Remaining</span>`;

          acolyteRow += '</div><div class="row" style="margin-bottom: 1px;">' +
            `<div class="progress" id="${acolyte.id}_progress" style="margin-left: 5px; margin-right: 5px;">` +
            `<div class="progress-bar grineer-invasion attack winning-left" role="progressbar" style="height: 20px; font-size: 12px; line-height:16px; width: ${remainingPercent}%" aria-valuenow="${remainingPercent}" aria-valuemin="0" aria-valuemax="100">` +
            `${remainingPercent > 0 ? remainingLabel : ''}</div>` +
            `<div class="progress-bar defend progress-bar-grey" role="progressbar" style="width: ${progressPercent}%; height: 20px; font-size: 12px; line-height:16px;" aria-valuenow="${progressPercent}" aria-valuemin="0" aria-valuemax="100">` +
            `${remainingPercent === 0 ? remainingLabel : ''}</div>` +
            '</div>';

          acolyteRow += '</li>';
          $('#acolytebody').before(acolyteRow);
        } else {
          const lastDiscoveredTime = moment(acolyte.lastDiscoveredTime).unix();
          $(`#${acolyte.id}-health`).html(`${(acolyte.healthPercent * 100).toFixed(2)}%`);
          $(`#${acolyte.id}-lastDiscoveredTime`).html(moment.unix(lastDiscoveredTime).format('h:mm:ss a, MM/DD/YYYY'));
        }
      }
    }
  } else if (document.getElementById('acolyteList')) {
    $('#acolyteList').children().not('#acolytebody').remove();
    document.getElementById('acolytetitle').innerText = 'No active acolytes';
    $('#alerttitle').show();
  }
}

function updateAlerts() {
  const {alerts} = worldState;
  if (alerts.length !== 0) {
    $('#alerttitle').hide();
    if (platformSwapped && document.getElementById('alertContainer')) {
      $('.alertsList').children().not('#alertbody').remove();
    }

    if (document.getElementById('alertContainer').children.length >= 1) {
      for (const alert of alerts) {
        if ($(`#${alert.id}`).length === 0) {
          let alertRow = `<div id="alertsTab" class="worldstateContainer">`;
          alertRow += `<div id="${alert.id}" class="alertTable">`;
          alertRow += `<ul>`;
          alertRow += `<img class="alertReward" src="${alert.mission.reward.thumbnail}">`;
          alertRow += `<li><b>${alert.mission.node}</b> <?=$lang_info_levels?>: ${alert.mission.minEnemyLevel}-${alert.mission.maxEnemyLevel}</li>`;
          alertRow += `<li>`;

          // Check if archwing is required for mission
          if (alert.mission.archwingRequired) {
            alertRow += '<img src="img/archwing.svg" class="archwing" height="16px" width="16px" alt="Archwing" /> ';
          }
          if (alert.mission.nightmare) {
            alertRow += '<img src="img/nightmare.svg" class="nightmare" height="16px" width="16px" alt="Nightmare" /> ';
          }

          alertRow += `<b>${alert.mission.type} - ${alert.mission.faction}</b></li>`;
          alertRow += `<li>Reward: <img id="alertItems" src="img/general/credits.png">` + numberWithCommas(alert.mission.reward.credits);

          if (alert.mission.reward.items.length !== 0) {
            for (const item of alert.mission.reward.items) {
              alertRow += `<span> + ${item}</span>`;
            }
          }
          if (alert.mission.reward.countedItems.length !== 0) {
            for (const countedItem of alert.mission.reward.countedItems) {
              alertRow += `<span> + ${countedItem.type} (${countedItem.count})</span>`;
            }
          }

          alertRow += `</li>`;
          alertRow += `</ul>`;

          alertRow += `<img class="svg alertFaction" src="img/factions/${alert.mission.faction}.svg">`;
          alertRow += `</div>`;

          alertRow += `<span id="alerttimer${alert.id}" class="timer alertTimer" data-starttime="${moment(alert.activation).unix()}" ` +
                        `data-endtime="${moment(alert.expiry).unix()}"></span>`;

          alertRow += `</div>`;
          $('#alertbody').before(alertRow);
        } else {
          const timer = $(`#alerttimer${alert.id}`);
          timer.attr('data-starttime', moment(alert.activation).unix());
          timer.attr('data-endtime', moment(alert.expiry).unix());
        }
      }
    } else {
      for (const alert of alerts) {
        let alertRow = `<div id="alertsTab" class="worldstateContainer">`;

        if (alert.mission.archwingRequired) {
          alertRow += '<img src="img/missions/archwing.svg" class="archwing" height="16px" width="16px" alt="Archwing" /> ';
        }
        if (alert.mission.nightmare) {
          alertRow += '<img src="img/missions/nightmare.svg" class="nightmare" height="16px" width="16px" alt="Nightmare" /> ';
        }
        alertRow += `<b>${alert.mission.node}</b> | ${alert.mission.type} (${alert.mission.faction})`;
        alertRow += `<span id="alerttimer${alert.id}" class="label timer pull-right" data-starttime="${moment(alert.activation).unix()}" ` +
                    `data-endtime="${moment(alert.expiry).unix()}"></span></li>`;
        $('#alertbody').before(alertRow);
      }
    }
  } else if (document.getElementById('alertContainer')) {
    $('#alertContainer').children().not('#alertbody').remove();
    document.getElementById('alerttitle').innerText = 'No active alerts';
    $('#alerttitle').show();
  }
  svgInject();
}

const cleanupBounties = dailyDeals => {
  if (platformSwapped && document.getElementsByClassName('bountiesList')) {
    $('#bountyTab.worldstateContainer').remove();
  } else if ($('.bountiesList').attr('id') !== dailyDeals[0].id) {
    $('#bountyTab.worldstateContainer').remove();
  }
};

function updateBounties() {
  const {syndicateMissions} = worldState;
  const ostronMissions = syndicateMissions.filter(syndicate => syndicate.syndicate === 'Ostrons')[0];
  const jobs = ostronMissions ? ostronMissions.jobs : [];
  if (jobs.length !== 0) {
    $('#bountytitle').hide();
    if (document.getElementById(jobs[0].id) === null) {
      cleanupBounties(jobs);

      // Table header, plat image
      for (const job of jobs) {
        const itemString = `<table id="bountyTab" class="worldstateContainer"><tr>` +
                    `<td><ul>` +
                    `<li>${job.type}</li>` +
                    `<li><img src="img/general/standing.svg" class="standing" />${job.standingStages.join(', ')}</li>` +
                    `<li><?=$lang_info_levels?>: ${job.enemyLevels[0]}-${job.enemyLevels[1]}</li>` +
                    `</td></ul>` +
                    `<td class="bountyRewardPool"><ul>${job.rewardPool.map(reward => `<li>${reward}</li>`).join('')}</ul></td>` +
                    `</tr></table>`;
        $('.bountiesList').append(itemString);
      }
    }
  } else if (document.getElementsByClassName('bountiesList')) {
    $('#bountyTab.worldstateContainer').remove();
    $('#bountytitle').text('No current deals');
    $('#bountytitle').show();
  }
}

function getFactionKey(faction) {
  switch (faction.toLowerCase()) {
  case 'corpus':
    return 'corpus';
  case 'grineer':
    return 'grineer';
  case 'infested':
  case 'infestation':
    return 'infested';
  case 'corrupted':
  case 'orokin':
  default:
    return 'corrupted';
  }
}

function updateSortie() {
  const {sortie} = worldState;

  if (sortie.variants.length !== 0) {
    $('#sortietitle').hide();

    if (platformSwapped || $('#sortieList').children().length === 0) {
      $('#sortieBoss').html(sortie.boss);
      $('#sortieFaction').html(
        '<img src="img/factions/' + getFactionKey(sortie.faction) + '.svg" class="sortieFaction" />'
      );
      $('#sortieList').empty();

      sortie.variants.forEach((variant, index) => {
        let sortieRow = `<ul id="variant_${index}">`;

        sortieRow += `<li>${variant.missionType}</b> - <b>${variant.node}</li>`;
        sortieRow += `<li><span data-toggle="tooltip" title="${variant.modifierDescription}" data-placement="right">${variant.modifier}</span></li>`;
        sortieRow += `</ul>`;

        $('#sortieList').append(sortieRow);
      });
    }
  } else {
    $('#sortietitle').show();
    $('#sortieList').find('#sortieList').empty();
  }
}

function updateFissure() {
  const {fissures} = worldState;

  if (fissures.length !== 0) {
    $('#fissuretitle').hide();
    if (platformSwapped && document.getElementsByClassName('fissureList')) {
      $('.fissureList').children().not('#fissurebody').remove();
    }

    fissures.sort((a, b) => {
      const tierA = a.tierNum;
      const tierB = b.tierNum;
      if (tierA < tierB) { return -1; }
      if (tierA > tierB) { return 1; }
      return 0;
    });

    for (const fissure of fissures) {
      if ($(`#${fissure.id}`).length !== 0) {
        const timer = $(`#fissuretimer${fissure.id}`);
        timer.attr('data-starttime', moment(fissure.activation).unix());
        timer.attr('data-endtime', moment(fissure.expiry).unix());
      } else {
        let fissureRow = `<div id="fissureTab" class="worldstateContainer">`;
        fissureRow += `<div id="${fissure.id}" class="alertTable">`;
        fissureRow += `<ul>`;
        fissureRow += `<img class="fissureTier" src="img/fissures/${fissure.tierNum}.svg" />`;
        fissureRow += `<li><b>${fissure.node}</b>`;
        fissureRow += `<li>`;
        fissureRow += `<b>${fissure.missionType} - ${fissure.enemy}</b></li>`;

        if (fissure.tierNum == 1) {
          var fissureTierLang = "<?=$lang_fissures_tier1?>";
        } else if (fissure.tierNum == 2) {
          var fissureTierLang = "<?=$lang_fissures_tier2?>";
        } else if (fissure.tierNum == 3) {
          var fissureTierLang = "<?=$lang_fissures_tier3?>";
        } else if (fissure.tierNum == 4) {
          var fissureTierLang = "<?=$lang_fissures_tier4?>";
        }

        fissureRow += `<li>` + fissureTierLang;
        fissureRow += `</li>`;
        fissureRow += `</ul>`;

        fissureRow += `<img class="svg alertFaction" src="img/factions/${fissure.enemy}.svg">`;
        fissureRow += `</div>`;
        fissureRow += `<span id="fissuretimer${fissure.id}" class="timer fissureTimer" data-starttime="${moment(fissure.activation).unix()}" ` +
                      `data-endtime="${moment(fissure.expiry).unix()}"></span>`;
        fissureRow += `</div>`;

        $('#fissurebody').before(fissureRow);
      }
    }
  } else {
    $('.fissureList').children().not('#fissurebody').remove();
    document.getElementById('fissuretitle').innerText = 'No active Void Fissures';
    $('#fissuretitle').show();
  }
  svgInject();
}

function updateNews() {
  let {news} = worldState;
  news = news.filter(article => article.translations.en);

  if (news.length !== 0) {
    $('#newstitle').hide();
    if (platformSwapped && document.getElementById('newsList')) {
      $('#newsList').children().not('#newsbody').remove();
    }

    news.sort((a, b) => {
      const timeA = moment(a.date).unix();
      const timeB = moment(b.date).unix();
      if (timeA < timeB) { return 1; }
      if (timeA > timeB) { return -1; }
      return 0;
    });

    for (const article of news) {
      if ($(`#${article.id}`).length !== 0) {
        $(`#newstime${article.id}`).html(`[${moment(article.date).fromNow()}] &#9;`);
      } else {
        let articleRow = `<li id="${article.id}" style="padding-top:2px;padding-bottom:2px">`;
        articleRow += `<span id="newstime${article.id}">[${moment(article.date).fromNow()}] &#9;</span><a href="${article.link}">${article.message}</a>`;
        articleRow += '</li>';

        if (article.priority) {
          $('#newstop').after(articleRow);
        } else {
          $('#newsbody').before(articleRow);
        }
      }
    }
  } else {
    $('#newsList').children().not('#newsbody').remove();
    document.getElementById('newstitle').innerText = 'No News to show';
    $('#newstitle').show();
  }
}

function updateInvasions() {
  const {invasions} = worldState;
  let numInvasions = 0;

  if (invasions.length !== 0) {

    if (platformSwapped && document.getElementsByClassName('invasionList')) {
      $('.invasionList').children().not('#invasionbody').remove();
    }

    invasions.forEach(invasion => {
      if ($(`#${invasion.id}`).length !== 0) {
        if (invasion.completed) {
          $(`#${invasion.id}`).remove();
        } else {
          $(`#${invasion.id}_info`).html(`<b>${invasion.node}</b><br>${invasion.desc} (Ends in: ${invasion.eta})`);
          const attackPercent =
                Math.floor(((invasion.count + invasion.requiredRuns)
                 / (invasion.requiredRuns * 2)) * 100);
          const defendPercent = 100 - attackPercent;

          const attackBar = $(`#${invasion.id}_progress`).children()[0];
          const defendBar = $(`#${invasion.id}_progress`).children()[1];

          if (invasion.count > 0) {
            $(attackBar).addClass('winning-right');
            $(defendBar).removeClass('winning-left');
          } else {
            $(attackBar).removeClass('winning-right');
            $(defendBar).addClass('winning-left');
          }

          $(attackBar).css('width', `${attackPercent}%`).css('aria-valuenow', `${attackPercent}%`);
          $(defendBar).css('width', `${defendPercent}%`).css('aria-valuenow', `${defendPercent}%`);
          numInvasions += 1;
        }
      } else if (!invasion.completed) {
        let invasionRow = `<div id="${invasion.id}" class="worldstateContainer">`;
        invasionRow += `<div class="invasionTable">`;
        invasionRow += `<ul>`;
        invasionRow += `<li id="invasionTitle"><b>${invasion.node}: ${invasion.desc}</b></li>`;

        const attackPercent =
              Math.floor(((invasion.count + invasion.requiredRuns)
               / (invasion.requiredRuns * 2)) * 100);
        const defendPercent = 100 - attackPercent;
        let attackWinning = '';
        let defendWinning = '';

        atkProgress = 'left';
        defProgress = 'right';

        invasionRow += `<li id="invasionSideA"><img class="alertFactionA" src="img/factions/${getFactionKey(invasion.attackingFaction)}.svg">${invasion.attackingFaction} ` + attackPercent +`%</li>`;
        invasionRow += `<li id="invasionSideD">` + defendPercent + `% ${invasion.defendingFaction}<img class="alertFactionD" src="img/factions/${getFactionKey(invasion.defendingFaction)}.svg"></li>`;
        invasionRow += `<div class="progress">`;
        invasionRow += `<span class="${getFactionKey(invasion.defendingFaction)}-color" style="width: ` + defendPercent + `%; float: ${defProgress}"></span>`;
        invasionRow += `<span class="${getFactionKey(invasion.attackingFaction)}-color" style="width: ` + attackPercent + `%; float: ${atkProgress}"></span>`;
        invasionRow += '</div>';

        if (invasion.attackerReward.items.length !== 0) {
          for (const item of invasion.attackerReward.items) {
            invasionRow += `<li id="invasionRewardA>${item}</li>`;
          }
        }
        if (invasion.attackerReward.countedItems.length !== 0) {
          for (const countedItem of invasion.attackerReward.countedItems) {
            // Include count only if more than 1
            if (countedItem.count > 1) {
              invasionRow += `<li id="invasionRewardA">${countedItem.type} (${countedItem.count})</li>`;
            } else {
              invasionRow += `<li id="invasionRewardA">${countedItem.type}</li>`;
            }
          }
        }

        if (invasion.defenderReward.items.length !== 0) {
          for (const item of invasion.defenderReward.items) {
            invasionRow += `<li id="invasionRewardD" class="label ${getLabelColor(invasion.defendingFaction)} pull-right">${item}</li>`;
          }
        }
        if (invasion.defenderReward.countedItems.length !== 0) {
          for (const countedItem of invasion.defenderReward.countedItems) {
            // Include count only if more than 1
            if (countedItem.count > 1) {
              invasionRow += `<li id="invasionRewardD">${countedItem.type} (${countedItem.count})</li>`;
            } else {
              invasionRow += `<li id="invasionRewardD">${countedItem.type}</li>`;
            }
          }
        }
        invasionRow += '<ul></div></div>';

        $('#invasionbody').before(invasionRow);
        numInvasions += 1;
      }
    });

    if (numInvasions === 0) {
      document.getElementById('invasiontitle').innerText = 'No active invasions';
    }
  } else {
    document.getElementById('invasiontitle').innerText = 'No active invasions';
  }
  svgInject();
}

function updateConstruction() {
	$.getJSON('<?=$dataserver?>/pc/constructionProgress', function (construction) {
		var grineerConstPercent = construction.fomorianProgress;
		var corpusConstPercent = construction.razorbackProgress;
		$('#grineerConstruct').attr("data-percentage", grineerConstPercent);
		$('#corpusConstruct').attr("data-percentage", corpusConstPercent);
    progressRender();
	});
}

function updatePage() {
  if (worldState) {
    updateEvents();
    updateEarthCycle();
    updateCetusCycle();
    updateVoidTrader();
    updateVoidTraderInventory();
    updateDarvoDeals();
    updateAcolytes();
    updateAlerts();
    updateBounties();
    updateCetusBountyTimer();
    updateSortie();
    updateFissure();
    updateNews();
    updateInvasions();
    updateConstruction();
    updateWorldStateTime();
  }
}

// Retrieves the easy to parse worldstate from WFCD
function getWorldState() {
  $.getJSON(`<?=$dataserver?>/${Cookies.get('platform')}`, data => {
    worldState = JSON.parse(JSON.stringify(data));
    updateTime = (new Date()).getTime();
    updateDataDependencies();
    updatePage();
  });
}

function updateResetTime() {
  // This should not be called again unless the timer expires
  // We want unix seconds, not unix millis
  const nextReset = (new Date()).setUTCHours(24, 0, 0, 0) / 1000;
  $('#resettimertitle').html('Time until new server day:');
  const timeBadge = $('#resettimertime');
  timeBadge.attr('data-endtime', nextReset);
  timeBadge.addClass('label timer');
}

function updateTimeBadges() {
  const labels = document.getElementsByClassName('timer');
  for (const label of labels) {
    const currentLabel = $(label);

    const activation = currentLabel.attr('data-starttime');
    let diffactivate;
    let durationactivate;

    if (typeof activation !== typeof undefined && activation !== false) {
      diffactivate = moment().diff(moment.unix(currentLabel.attr('data-starttime'))) * -1;
      durationactivate = moment.duration(diffactivate, 'milliseconds');
    }

    const diff = moment().diff(moment.unix(currentLabel.attr('data-endtime'))) * -1;
    const duration = moment.duration(diff, 'milliseconds');
    // Not started
    if (typeof diffactivate !== 'undefined' && diffactivate > 0) {
      currentLabel.html(`Starts in: ${formatDurationShort(durationactivate)}`);
    } else if (diff < 0) { // Expired
      currentLabel.html(`Expired: ${formatDurationShort(duration)}`);

      // Refreshes for things we don't need worldstate for
      switch (currentLabel.attr('id')) {
      case 'cetuscycletime':
        updateCetusCycle();
        break;
      case 'earthcycletime':
        updateEarthCycle();
        break;
      case 'resettimertime':
        updateResetTime();
        break;
      default:
        // If it is a alert timer, we can safely remove
        if (currentLabel.attr('id')
          && (currentLabel.attr('id').includes('alerttimer') || currentLabel.attr('id').includes('fissuretimer'))) {
          currentLabel.parent()[0].remove();
        }
      }
    }
    currentLabel.html(formatDurationShort(duration));
  }

  setTimeout(updateTimeBadges, 1000);
}

function updatePlatformSwitch() {
  platformSwapped = false;
}

// Change color of active platform
function selectPlatform(platform) {
  const cls = 'list-group-item-success';
  $('.platform-picker li')
    .removeClass(cls)
    .filter(`[data-platform="${platform}"]`)
    .addClass(cls);
}

// Set default platform to PC if there isn't one
if (typeof Cookies.get('platform') === 'undefined') {
  Cookies.set('platform', 'pc');
}
selectPlatform(Cookies.get('platform'));

// Platform switcher
$('.platform-picker li').click(e => {
  const platform = $(e.currentTarget).attr('data-platform');
  selectPlatform(platform);
  Cookies.set('platform', platform);
  platformSwapped = true;
  getWorldState();
  setTimeout(updatePlatformSwitch, 30000);
});

moment.updateLocale('en', {
  relativeTime: {
    future: 'in %s',
    past: '%s',
    s: '1s',
    ss: '%ss',
    m: '1m',
    mm: '%dm',
    h: '1h',
    hh: '%dh',
    d: '1d',
    dd: '%dd',
    M: '1M',
    MM: '%dM',
    y: '1Y',
    yy: '%dY',
  },
});

// Main data refresh loop every 60 minutes
function update() {
  getWorldState();
  setTimeout(update, 30000);
}

update();
wsHideAll()
$('#alertContainer').css("display", "block");
updateTimeBadges(); // Method has its own 1 second timeout
updateResetTime(); // This should not be called again unless the timer expires
