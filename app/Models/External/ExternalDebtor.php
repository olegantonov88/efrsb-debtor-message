<?php

namespace App\Models\External;

use App\Casts\ExternalDebtor\AddressDebtorCast;
use App\Casts\ExternalDebtor\BirthDebtorCast;
use App\Casts\ExternalDebtor\ContactsDebtorCast;
use App\Casts\ExternalDebtor\DeathDebtorCast;
use App\Casts\ExternalDebtor\EgrulExcludedDebtorCast;
use App\Casts\ExternalDebtor\LivingWageDebtorCast;
use App\Casts\ExternalDebtor\ManagerDebtorDebtorCast;
use App\Casts\ExternalDebtor\PassportDebtorDebtorCast;
use App\Casts\ExternalDebtor\PreviousFioDebtorCast;
use App\Casts\ExternalDebtor\PreviousPassportDebtorCast;
use App\Casts\ExternalDebtor\PropertiesDebtorCast;
use App\Enums\Debtor\CategoryDebtor;
use App\Enums\User\UserSex;
use App\Enums\User\UserType;
use App\ValueObjects\ExternalDebtor\PropertiesDebtorObject;

class ExternalDebtor extends ExternalModel
{
    protected $table = 'debtors';

    protected $guarded = [];

    protected $casts = [
        'is_closed' => 'boolean',
        'type' => UserType::class,
        'sex' => UserSex::class,
        'passport' => PassportDebtorDebtorCast::class,
        'previous_fio' => PreviousFioDebtorCast::class,
        'previous_passport' => PreviousPassportDebtorCast::class,
        'birth' => BirthDebtorCast::class,
        'is_died' => 'boolean',
        'death' => DeathDebtorCast::class,
        'is_deregistred' => 'boolean',
        'is_receive_living_wage' => 'boolean',
        'living_wage' => LivingWageDebtorCast::class,
        'manager' => ManagerDebtorDebtorCast::class,
        'address' => AddressDebtorCast::class,
        'contacts' => ContactsDebtorCast::class,
        'category' => CategoryDebtor::class,
        'date_dismissal_workers' => 'date',
        'egrul_excluded' => EgrulExcludedDebtorCast::class,
        'properties' => PropertiesDebtorCast::class,
    ];

    /**
     * efrsb_id хранится во внешней таблице в JSON поле properties.
     */
    public function getEfrsbId(): ?string
    {
        $props = $this->properties;
        $efrsbId = $props?->efrsb_id ?? null;

        return is_string($efrsbId) && $efrsbId !== '' ? $efrsbId : null;
    }

    /**
     * Тип должника для fedresurs-message-list: organization/person.
     * Физлицо и ИП считаем "person".
     */
    public function getFedresursDebtorType(): string
    {
        $type = $this->type;

        if ($type instanceof UserType) {
            return $type === UserType::COMPANY ? 'organization' : 'person';
        }

        // fallback если тип не распознан
        return 'organization';
    }

    public function setEfrsbId(string $efrsbId): void
    {
        $props = $this->properties;
        if (!$props instanceof PropertiesDebtorObject) {
            $props = PropertiesDebtorObject::fromArray([]);
        }

        $props->efrsb_id = $efrsbId;
        $this->properties = $props;
    }
}


