<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaptivePortail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaptivePortail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaptivePortail query()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCaptivePortail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $subject
 * @property string $email
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Email whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property string $pakage_type
 * @property string $receiver_number
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal wherePakageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereReceiverNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MoneyWithdrawal whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMoneyWithdrawal {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $admin_id
 * @property string $type
 * @property string $name
 * @property string $fixed_charge
 * @property string $percent_charge
 * @property string $min_limit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereFixedCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereMinLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage wherePercentCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pakage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPakage {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $pakage_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser wherePakageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PakageUser whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPakageUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $zone_wifi_id
 * @property string $username
 * @property string $password
 * @property string|null $profile
 * @property string|null $time_limit
 * @property string|null $data_limit
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereDataLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereTimeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketWifi whereZoneWifiId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTicketWifi {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $ticket_wifi_id
 * @property int $money_withdrawal_id
 * @property string $type
 * @property string $status
 * @property string $receiver_number
 * @property string $price
 * @property string|null $charge
 * @property string|null $sms_charge
 * @property string $net_price
 * @property string|null $vendor_reference
 * @property string|null $operation_reference
 * @property int $is_collected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereIsCollected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereMoneyWithdrawalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereNetPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereOperationReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereReceiverNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereSmsCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereTicketWifiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereVendorReference($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTransaction {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $contry
 * @property string $number
 * @property string $city
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereContry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $captive_gate
 * @property string|null $description
 * @property string|null $image
 * @property string|null $message
 * @property int $is_active_sms
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereCaptiveGate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereIsActiveSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ZoneWifi whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperZoneWifi {}
}

