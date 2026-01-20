<?php

namespace App\Enums;

enum Regions: int
{
    case RESPUBLIKA_ADYGEYA = 1;
    case RESPUBLIKA_BASHKORTOSTAN = 2;
    case RESPUBLIKA_BURYATIYA = 3;
    case RESPUBLIKA_ALTAI = 4;
    case RESPUBLIKA_DAGESTAN = 5;
    case RESPUBLIKA_INGUSHETIYA = 6;
    case KABARDINO_BALKARSKAYA_RESPUBLIKA = 7;
    case RESPUBLIKA_KALMYKIYA = 8;
    case KARACHAEVO_CHERKESSKAYA_RESPUBLIKA = 9;
    case RESPUBLIKA_KARELIYA = 10;
    case RESPUBLIKA_KOMI = 11;
    case RESPUBLIKA_MARIY_EL = 12;
    case RESPUBLIKA_MORDOVIYA = 13;
    case RESPUBLIKA_SAHA_YAKUTIYA = 14;
    case RESPUBLIKA_SEVERNAYA_OSETIYA_ALANIYA = 15;
    case RESPUBLIKA_TATARSTAN = 16;
    case RESPUBLIKA_TYVA = 17;
    case UDMURTSKAYA_RESPUBLIKA = 18;
    case RESPUBLIKA_KHAKASIYA = 19;
    case CHECHENSKAYA_RESPUBLIKA = 20;
    case CHUVASHKAYA_RESPUBLIKA_CHUVASHIYA = 21;
    case ALTAISKY_KRAI = 22;
    case KRASNODARSKY_KRAI = 23;
    case KRASNOYARSKY_KRAI = 24;
    case PRIMORSKY_KRAI = 25;
    case STAVROPOLSKY_KRAI = 26;
    case KHABAROVSKY_KRAI = 27;
    case AMURSKAYA_OBLAST = 28;
    case ARKHANGELSKAYA_OBLAST = 29;
    case ASTRKHANSKAYA_OBLAST = 30;
    case BELGORODSKAYA_OBLAST = 31;
    case BRYANSKAYA_OBLAST = 32;
    case VLADIMIRSKAYA_OBLAST = 33;
    case VOLGOGRADSKAYA_OBLAST = 34;
    case VOLOGODSKAYA_OBLAST = 35;
    case VORONEZHSKAYA_OBLAST = 36;
    case IVANOVSKAYA_OBLAST = 37;
    case IRKUTSKAYA_OBLAST = 38;
    case KALININGRADSKAYA_OBLAST = 39;
    case KALUZHSKAYA_OBLAST = 40;
    case KAMCHATSKY_KRAI = 41;
    case KEMEROVSKAYA_OBLAST_KUZBASS = 42;
    case KIROVSKAYA_OBLAST = 43;
    case KOSTROMSKAYA_OBLAST = 44;
    case KURGANASKAYA_OBLAST = 45;
    case KURSKAYA_OBLAST = 46;
    case LENINGRADSKAYA_OBLAST = 47;
    case LIPECKAYA_OBLAST = 48;
    case MAGADANSKAYA_OBLAST = 49;
    case MOSKOVSKAYA_OBLAST = 50;
    case MURMANSKAYA_OBLAST = 51;
    case NIZHEGORODSKAYA_OBLAST = 52;
    case NOVGORODSKAYA_OBLAST = 53;
    case NOVOSIBIRSKAYA_OBLAST = 54;
    case OMSKAYA_OBLAST = 55;
    case ORENBURSKAYA_OBLAST = 56;
    case ORLOVSKAYA_OBLAST = 57;
    case PENZENSKAYA_OBLAST = 58;
    case PERMSKY_KRAI = 59;
    case PSKOVSKAYA_OBLAST = 60;
    case ROSTOVSKAYA_OBLAST = 61;
    case RYAZANSKAYA_OBLAST = 62;
    case SAMARSKAYA_OBLAST = 63;
    case SARATOVSKAYA_OBLAST = 64;
    case SAKHALINSKAYA_OBLAST = 65;
    case SVERDLOVSKAYA_OBLAST = 66;
    case SMOLENSKAYA_OBLAST = 67;
    case TAMBOVSKAYA_OBLAST = 68;
    case TVERSKAYA_OBLAST = 69;
    case TOMSKAYA_OBLAST = 70;
    case TULSKAYA_OBLAST = 71;
    case TYUMENSKAYA_OBLAST = 72;
    case ULYANOVSKAYA_OBLAST = 73;
    case CHELYABINSKAYA_OBLAST = 74;
    case ZABAIKALSKY_KRAI = 75;
    case YAROSLAVSKAYA_OBLAST = 76;
    case GOROD_MOSKVA = 77;
    case GOROD_SANKT_PETERBURG = 78;
    case EVREISKAYA_AVTONOMNAYA_OBLAST = 79;
    case NENETSKY_AVTONOMNY_OKRUG = 83;
    case KHANTY_MANSIYSKY_AVTONOMNY_OKRUG_YUGRA = 86;
    case CHUKOTSKY_AVTONOMNY_OKRUG = 87;
    case YAMALO_NENETSKY_AVTONOMNY_OKRUG = 89;
    case RESPUBLIKA_KRYM = 91;
    case GOROD_SEVASTOPOL = 92;
    case DONYTSKAYA_NARODNAYA_RESPUBLIKA = 93;
    case LUHANSKAYA_NARODNAYA_RESPUBLIKA = 94;
    case HERSONSKAYA_OBLAST = 95;
    case INYE_TERRITORII_I_KOSMODROM_BAIKONUR = 99;

    public function text(): string
    {
        return match ($this) {
            self::RESPUBLIKA_ADYGEYA => 'Республика Адыгея',
            self::RESPUBLIKA_BASHKORTOSTAN => 'Республика Башкортостан',
            self::RESPUBLIKA_BURYATIYA => 'Республика Бурятия',
            self::RESPUBLIKA_ALTAI => 'Республика Алтай',
            self::RESPUBLIKA_DAGESTAN => 'Республика Дагестан',
            self::RESPUBLIKA_INGUSHETIYA => 'Республика Ингушетия',
            self::KABARDINO_BALKARSKAYA_RESPUBLIKA => 'Кабардино-Балкарская Республика',
            self::RESPUBLIKA_KALMYKIYA => 'Республика Калмыкия',
            self::KARACHAEVO_CHERKESSKAYA_RESPUBLIKA => 'Карачаево-Черкесская Республика',
            self::RESPUBLIKA_KARELIYA => 'Республика Карелия',
            self::RESPUBLIKA_KOMI => 'Республика Коми',
            self::RESPUBLIKA_MARIY_EL => 'Республика Марий Эл',
            self::RESPUBLIKA_MORDOVIYA => 'Республика Мордовия',
            self::RESPUBLIKA_SAHA_YAKUTIYA => 'Республика Саха (Якутия)',
            self::RESPUBLIKA_SEVERNAYA_OSETIYA_ALANIYA => 'Республика Северная Осетия - Алания',
            self::RESPUBLIKA_TATARSTAN => 'Республика Татарстан (Татарстан)',
            self::RESPUBLIKA_TYVA => 'Республика Тыва',
            self::UDMURTSKAYA_RESPUBLIKA => 'Удмуртская Республика',
            self::RESPUBLIKA_KHAKASIYA => 'Республика Хакасия',
            self::CHECHENSKAYA_RESPUBLIKA => 'Чеченская Республика',
            self::CHUVASHKAYA_RESPUBLIKA_CHUVASHIYA => 'Чувашская Республика - Чувашия',
            self::ALTAISKY_KRAI => 'Алтайский край',
            self::KRASNODARSKY_KRAI => 'Краснодарский край',
            self::KRASNOYARSKY_KRAI => 'Красноярский край',
            self::PRIMORSKY_KRAI => 'Приморский край',
            self::STAVROPOLSKY_KRAI => 'Ставропольский край',
            self::KHABAROVSKY_KRAI => 'Хабаровский край',
            self::AMURSKAYA_OBLAST => 'Амурская область',
            self::ARKHANGELSKAYA_OBLAST => 'Архангельская область',
            self::ASTRKHANSKAYA_OBLAST => 'Астраханская область',
            self::BELGORODSKAYA_OBLAST => 'Белгородская область',
            self::BRYANSKAYA_OBLAST => 'Брянская область',
            self::VLADIMIRSKAYA_OBLAST => 'Владимирская область',
            self::VOLGOGRADSKAYA_OBLAST => 'Волгоградская область',
            self::VOLOGODSKAYA_OBLAST => 'Вологодская область',
            self::VORONEZHSKAYA_OBLAST => 'Воронежская область',
            self::IVANOVSKAYA_OBLAST => 'Ивановская область',
            self::IRKUTSKAYA_OBLAST => 'Иркутская область',
            self::KALININGRADSKAYA_OBLAST => 'Калининградская область',
            self::KALUZHSKAYA_OBLAST => 'Калужская область',
            self::KAMCHATSKY_KRAI => 'Камчатский край',
            self::KEMEROVSKAYA_OBLAST_KUZBASS => 'Кемеровская область - Кузбасс',
            self::KIROVSKAYA_OBLAST => 'Кировская область',
            self::KOSTROMSKAYA_OBLAST => 'Костромская область',
            self::KURGANASKAYA_OBLAST => 'Курганская область',
            self::KURSKAYA_OBLAST => 'Курская область',
            self::LENINGRADSKAYA_OBLAST => 'Ленинградская область',
            self::LIPECKAYA_OBLAST => 'Липецкая область',
            self::MAGADANSKAYA_OBLAST => 'Магаданская область',
            self::MOSKOVSKAYA_OBLAST => 'Московская область',
            self::MURMANSKAYA_OBLAST => 'Мурманская область',
            self::NIZHEGORODSKAYA_OBLAST => 'Нижегородская область',
            self::NOVGORODSKAYA_OBLAST => 'Новгородская область',
            self::NOVOSIBIRSKAYA_OBLAST => 'Новосибирская область',
            self::OMSKAYA_OBLAST => 'Омская область',
            self::ORENBURSKAYA_OBLAST => 'Оренбургская область',
            self::ORLOVSKAYA_OBLAST => 'Орловская область',
            self::PENZENSKAYA_OBLAST => 'Пензенская область',
            self::PERMSKY_KRAI => 'Пермский край',
            self::PSKOVSKAYA_OBLAST => 'Псковская область',
            self::ROSTOVSKAYA_OBLAST => 'Ростовская область',
            self::RYAZANSKAYA_OBLAST => 'Рязанская область',
            self::SAMARSKAYA_OBLAST => 'Самарская область',
            self::SARATOVSKAYA_OBLAST => 'Саратовская область',
            self::SAKHALINSKAYA_OBLAST => 'Сахалинская область',
            self::SVERDLOVSKAYA_OBLAST => 'Свердловская область',
            self::SMOLENSKAYA_OBLAST => 'Смоленская область',
            self::TAMBOVSKAYA_OBLAST => 'Тамбовская область',
            self::TVERSKAYA_OBLAST => 'Тверская область',
            self::TOMSKAYA_OBLAST => 'Томская область',
            self::TULSKAYA_OBLAST => 'Тульская область',
            self::TYUMENSKAYA_OBLAST => 'Тюменская область',
            self::ULYANOVSKAYA_OBLAST => 'Ульяновская область',
            self::CHELYABINSKAYA_OBLAST => 'Челябинская область',
            self::ZABAIKALSKY_KRAI => 'Забайкальский край',
            self::YAROSLAVSKAYA_OBLAST => 'Ярославская область',
            self::GOROD_MOSKVA => 'г. Москва',
            self::GOROD_SANKT_PETERBURG => 'г. Санкт-Петербург',
            self::EVREISKAYA_AVTONOMNAYA_OBLAST => 'Еврейская автономная область',
            self::NENETSKY_AVTONOMNY_OKRUG => 'Ненецкий автономный округ',
            self::KHANTY_MANSIYSKY_AVTONOMNY_OKRUG_YUGRA => 'Ханты-Мансийский автономный округ - Югра',
            self::CHUKOTSKY_AVTONOMNY_OKRUG => 'Чукотский автономный округ',
            self::YAMALO_NENETSKY_AVTONOMNY_OKRUG => 'Ямало-Ненецкий автономный округ',
            self::RESPUBLIKA_KRYM => 'Республика Крым',
            self::GOROD_SEVASTOPOL => 'г. Севастополь',
            self::DONYTSKAYA_NARODNAYA_RESPUBLIKA => 'Донецкая Народная Республика',
            self::LUHANSKAYA_NARODNAYA_RESPUBLIKA => 'Луганская Народная Республика',
            self::HERSONSKAYA_OBLAST => 'Херсонская область',
            self::INYE_TERRITORII_I_KOSMODROM_BAIKONUR => 'иные территории, включая город и космодром Байконур',
        };
    }

    public function textWhere(): string
    {
        return match ($this) {
            self::RESPUBLIKA_ADYGEYA => 'Республике Адыгее',
            self::RESPUBLIKA_BASHKORTOSTAN => 'Республике Башкортостан',
            self::RESPUBLIKA_BURYATIYA => 'Республике Бурятии',
            self::RESPUBLIKA_ALTAI => 'Республике Алтае',
            self::RESPUBLIKA_DAGESTAN => 'Республике Дагестане',
            self::RESPUBLIKA_INGUSHETIYA => 'Республике Ингушетии',
            self::KABARDINO_BALKARSKAYA_RESPUBLIKA => 'Кабардино-Балкарской Республике',
            self::RESPUBLIKA_KALMYKIYA => 'Республике Калмыкии',
            self::KARACHAEVO_CHERKESSKAYA_RESPUBLIKA => 'Карачаево-Черкесской Республике',
            self::RESPUBLIKA_KARELIYA => 'Республике Карелии',
            self::RESPUBLIKA_KOMI => 'Республике Коми',
            self::RESPUBLIKA_MARIY_EL => 'Республике Марий Эл',
            self::RESPUBLIKA_MORDOVIYA => 'Республике Мордовии',
            self::RESPUBLIKA_SAHA_YAKUTIYA => 'Республике Саха (Якутии)',
            self::RESPUBLIKA_SEVERNAYA_OSETIYA_ALANIYA => 'Республике Северной Осетии - Алании',
            self::RESPUBLIKA_TATARSTAN => 'Республике Татарстан',
            self::RESPUBLIKA_TYVA => 'Республике Тыве',
            self::UDMURTSKAYA_RESPUBLIKA => 'Удмуртской Республике',
            self::RESPUBLIKA_KHAKASIYA => 'Республике Хакасии',
            self::CHECHENSKAYA_RESPUBLIKA => 'Чеченской Республике',
            self::CHUVASHKAYA_RESPUBLIKA_CHUVASHIYA => 'Чувашской Республике - Чувашии',
            self::ALTAISKY_KRAI => 'Алтайском краю',
            self::KRASNODARSKY_KRAI => 'Краснодарском крае',
            self::KRASNOYARSKY_KRAI => 'Красноярском крае',
            self::PRIMORSKY_KRAI => 'Приморском крае',
            self::STAVROPOLSKY_KRAI => 'Ставропольском крае',
            self::KHABAROVSKY_KRAI => 'Хабаровском крае',
            self::AMURSKAYA_OBLAST => 'Амурской области',
            self::ARKHANGELSKAYA_OBLAST => 'Архангельской области',
            self::ASTRKHANSKAYA_OBLAST => 'Астраханской области',
            self::BELGORODSKAYA_OBLAST => 'Белгородской области',
            self::BRYANSKAYA_OBLAST => 'Брянской области',
            self::VLADIMIRSKAYA_OBLAST => 'Владимирской области',
            self::VOLGOGRADSKAYA_OBLAST => 'Волгоградской области',
            self::VOLOGODSKAYA_OBLAST => 'Вологодской области',
            self::VORONEZHSKAYA_OBLAST => 'Воронежской области',
            self::IVANOVSKAYA_OBLAST => 'Ивановской области',
            self::IRKUTSKAYA_OBLAST => 'Иркутской области',
            self::KALININGRADSKAYA_OBLAST => 'Калининградской области',
            self::KALUZHSKAYA_OBLAST => 'Калужской области',
            self::KAMCHATSKY_KRAI => 'Камчатском крае',
            self::KEMEROVSKAYA_OBLAST_KUZBASS => 'Кемеровской области - Кузбассе',
            self::KIROVSKAYA_OBLAST => 'Кировской области',
            self::KOSTROMSKAYA_OBLAST => 'Костромской области',
            self::KURGANASKAYA_OBLAST => 'Курганской области',
            self::KURSKAYA_OBLAST => 'Курской области',
            self::LENINGRADSKAYA_OBLAST => 'Ленинградской области',
            self::LIPECKAYA_OBLAST => 'Липецкой области',
            self::MAGADANSKAYA_OBLAST => 'Магаданской области',
            self::MOSKOVSKAYA_OBLAST => 'Московской области',
            self::MURMANSKAYA_OBLAST => 'Мурманской области',
            self::NIZHEGORODSKAYA_OBLAST => 'Нижегородской области',
            self::NOVGORODSKAYA_OBLAST => 'Новгородской области',
            self::NOVOSIBIRSKAYA_OBLAST => 'Новосибирской области',
            self::OMSKAYA_OBLAST => 'Омской области',
            self::ORENBURSKAYA_OBLAST => 'Оренбургской области',
            self::ORLOVSKAYA_OBLAST => 'Орловской области',
            self::PENZENSKAYA_OBLAST => 'Пензенской области',
            self::PERMSKY_KRAI => 'Пермском крае',
            self::PSKOVSKAYA_OBLAST => 'Псковской области',
            self::ROSTOVSKAYA_OBLAST => 'Ростовской области',
            self::RYAZANSKAYA_OBLAST => 'Рязанской области',
            self::SAMARSKAYA_OBLAST => 'Самарской области',
            self::SARATOVSKAYA_OBLAST => 'Саратовской области',
            self::SAKHALINSKAYA_OBLAST => 'Сахалинской области',
            self::SVERDLOVSKAYA_OBLAST => 'Свердловской области',
            self::SMOLENSKAYA_OBLAST => 'Смоленской области',
            self::TAMBOVSKAYA_OBLAST => 'Тамбовской области',
            self::TVERSKAYA_OBLAST => 'Тверской области',
            self::TOMSKAYA_OBLAST => 'Томской области',
            self::TULSKAYA_OBLAST => 'Тульской области',
            self::TYUMENSKAYA_OBLAST => 'Тюменской области',
            self::ULYANOVSKAYA_OBLAST => 'Ульяновской области',
            self::CHELYABINSKAYA_OBLAST => 'Челябинской области',
            self::ZABAIKALSKY_KRAI => 'Забайкальском крае',
            self::YAROSLAVSKAYA_OBLAST => 'Ярославской области',
            self::GOROD_MOSKVA => 'городе Москва',
            self::GOROD_SANKT_PETERBURG => 'городе Санкт-Петербург',
            self::EVREISKAYA_AVTONOMNAYA_OBLAST => 'Еврейской автономной области',
            self::NENETSKY_AVTONOMNY_OKRUG => 'Ненецком автономном округе',
            self::KHANTY_MANSIYSKY_AVTONOMNY_OKRUG_YUGRA => 'Ханты-Мансийском автономном округе - Югре',
            self::CHUKOTSKY_AVTONOMNY_OKRUG => 'Чукотском автономном округе',
            self::YAMALO_NENETSKY_AVTONOMNY_OKRUG => 'Ямало-Ненецком автономном округе',
            self::RESPUBLIKA_KRYM => 'Республике Крым',
            self::GOROD_SEVASTOPOL => 'городе Севастополь',
            self::DONYTSKAYA_NARODNAYA_RESPUBLIKA => 'Донецкой Народной Республике',
            self::LUHANSKAYA_NARODNAYA_RESPUBLIKA => 'Луганской Народной Республике',
            self::HERSONSKAYA_OBLAST => 'Херсонской области',
        };
    }

    static public function textAllTypeArray()
    {
        return [
            ['id' => self::RESPUBLIKA_ADYGEYA->value, 'name' => self::RESPUBLIKA_ADYGEYA->name, 'value' => 'Республика Адыгея'],
            ['id' => self::RESPUBLIKA_BASHKORTOSTAN->value, 'name' => self::RESPUBLIKA_BASHKORTOSTAN->name, 'value' => 'Республика Башкортостан'],
            ['id' => self::RESPUBLIKA_BURYATIYA->value, 'name' => self::RESPUBLIKA_BURYATIYA->name, 'value' => 'Республика Бурятия'],
            ['id' => self::RESPUBLIKA_ALTAI->value, 'name' => self::RESPUBLIKA_ALTAI->name, 'value' => 'Республика Алтай'],
            ['id' => self::RESPUBLIKA_DAGESTAN->value, 'name' => self::RESPUBLIKA_DAGESTAN->name, 'value' => 'Республика Дагестан'],
            ['id' => self::RESPUBLIKA_INGUSHETIYA->value, 'name' => self::RESPUBLIKA_INGUSHETIYA->name, 'value' => 'Республика Ингушетия'],
            ['id' => self::KABARDINO_BALKARSKAYA_RESPUBLIKA->value, 'name' => self::KABARDINO_BALKARSKAYA_RESPUBLIKA->name, 'value' => 'Кабардино-Балкарская Республика'],
            ['id' => self::RESPUBLIKA_KALMYKIYA->value, 'name' => self::RESPUBLIKA_KALMYKIYA->name, 'value' => 'Республика Калмыкия'],
            ['id' => self::KARACHAEVO_CHERKESSKAYA_RESPUBLIKA->value, 'name' => self::KARACHAEVO_CHERKESSKAYA_RESPUBLIKA->name, 'value' => 'Карачаево-Черкесская Республика'],
            ['id' => self::RESPUBLIKA_KARELIYA->value, 'name' => self::RESPUBLIKA_KARELIYA->name, 'value' => 'Республика Карелия'],
            ['id' => self::RESPUBLIKA_KOMI->value, 'name' => self::RESPUBLIKA_KOMI->name, 'value' => 'Республика Коми'],
            ['id' => self::RESPUBLIKA_MARIY_EL->value, 'name' => self::RESPUBLIKA_MARIY_EL->name, 'value' => 'Республика Марий Эл'],
            ['id' => self::RESPUBLIKA_MORDOVIYA->value, 'name' => self::RESPUBLIKA_MORDOVIYA->name, 'value' => 'Республика Мордовия'],
            ['id' => self::RESPUBLIKA_SAHA_YAKUTIYA->value, 'name' => self::RESPUBLIKA_SAHA_YAKUTIYA->name, 'value' => 'Республика Саха (Якутия)'],
            ['id' => self::RESPUBLIKA_SEVERNAYA_OSETIYA_ALANIYA->value, 'name' => self::RESPUBLIKA_SEVERNAYA_OSETIYA_ALANIYA->name, 'value' => 'Республика Северная Осетия - Алания'],
            ['id' => self::RESPUBLIKA_TATARSTAN->value, 'name' => self::RESPUBLIKA_TATARSTAN->name, 'value' => 'Республика Татарстан (Татарстан)'],
            ['id' => self::RESPUBLIKA_TYVA->value, 'name' => self::RESPUBLIKA_TYVA->name, 'value' => 'Республика Тыва'],
            ['id' => self::UDMURTSKAYA_RESPUBLIKA->value, 'name' => self::UDMURTSKAYA_RESPUBLIKA->name, 'value' => 'Удмуртская Республика'],
            ['id' => self::RESPUBLIKA_KHAKASIYA->value, 'name' => self::RESPUBLIKA_KHAKASIYA->name, 'value' => 'Республика Хакасия'],
            ['id' => self::CHECHENSKAYA_RESPUBLIKA->value, 'name' => self::CHECHENSKAYA_RESPUBLIKA->name, 'value' => 'Чеченская Республика'],
            ['id' => self::CHUVASHKAYA_RESPUBLIKA_CHUVASHIYA->value, 'name' => self::CHUVASHKAYA_RESPUBLIKA_CHUVASHIYA->name, 'value' => 'Чувашская Республика - Чувашия'],
            ['id' => self::ALTAISKY_KRAI->value, 'name' => self::ALTAISKY_KRAI->name, 'value' => 'Алтайский край'],
            ['id' => self::KRASNODARSKY_KRAI->value, 'name' => self::KRASNODARSKY_KRAI->name, 'value' => 'Краснодарский край'],
            ['id' => self::KRASNOYARSKY_KRAI->value, 'name' => self::KRASNOYARSKY_KRAI->name, 'value' => 'Красноярский край'],
            ['id' => self::PRIMORSKY_KRAI->value, 'name' => self::PRIMORSKY_KRAI->name, 'value' => 'Приморский край'],
            ['id' => self::STAVROPOLSKY_KRAI->value, 'name' => self::STAVROPOLSKY_KRAI->name, 'value' => 'Ставропольский край'],
            ['id' => self::KHABAROVSKY_KRAI->value, 'name' => self::KHABAROVSKY_KRAI->name, 'value' => 'Хабаровский край'],
            ['id' => self::AMURSKAYA_OBLAST->value, 'name' => self::AMURSKAYA_OBLAST->name, 'value' => 'Амурская область'],
            ['id' => self::ARKHANGELSKAYA_OBLAST->value, 'name' => self::ARKHANGELSKAYA_OBLAST->name, 'value' => 'Архангельская область'],
            ['id' => self::ASTRKHANSKAYA_OBLAST->value, 'name' => self::ASTRKHANSKAYA_OBLAST->name, 'value' => 'Астраханская область'],
            ['id' => self::BELGORODSKAYA_OBLAST->value, 'name' => self::BELGORODSKAYA_OBLAST->name, 'value' => 'Белгородская область'],
            ['id' => self::BRYANSKAYA_OBLAST->value, 'name' => self::BRYANSKAYA_OBLAST->name, 'value' => 'Брянская область'],
            ['id' => self::VLADIMIRSKAYA_OBLAST->value, 'name' => self::VLADIMIRSKAYA_OBLAST->name, 'value' => 'Владимирская область'],
            ['id' => self::VOLGOGRADSKAYA_OBLAST->value, 'name' => self::VOLGOGRADSKAYA_OBLAST->name, 'value' => 'Волгоградская область'],
            ['id' => self::VOLOGODSKAYA_OBLAST->value, 'name' => self::VOLOGODSKAYA_OBLAST->name, 'value' => 'Вологодская область'],
            ['id' => self::VORONEZHSKAYA_OBLAST->value, 'name' => self::VORONEZHSKAYA_OBLAST->name, 'value' => 'Воронежская область'],
            ['id' => self::IVANOVSKAYA_OBLAST->value, 'name' => self::IVANOVSKAYA_OBLAST->name, 'value' => 'Ивановская область'],
            ['id' => self::IRKUTSKAYA_OBLAST->value, 'name' => self::IRKUTSKAYA_OBLAST->name, 'value' => 'Иркутская область'],
            ['id' => self::KALININGRADSKAYA_OBLAST->value, 'name' => self::KALININGRADSKAYA_OBLAST->name, 'value' => 'Калининградская область'],
            ['id' => self::KALUZHSKAYA_OBLAST->value, 'name' => self::KALUZHSKAYA_OBLAST->name, 'value' => 'Калужская область'],
            ['id' => self::KAMCHATSKY_KRAI->value, 'name' => self::KAMCHATSKY_KRAI->name, 'value' => 'Камчатский край'],
            ['id' => self::KEMEROVSKAYA_OBLAST_KUZBASS->value, 'name' => self::KEMEROVSKAYA_OBLAST_KUZBASS->name, 'value' => 'Кемеровская область - Кузбасс'],
            ['id' => self::KIROVSKAYA_OBLAST->value, 'name' => self::KIROVSKAYA_OBLAST->name, 'value' => 'Кировская область'],
            ['id' => self::KOSTROMSKAYA_OBLAST->value, 'name' => self::KOSTROMSKAYA_OBLAST->name, 'value' => 'Костромская область'],
            ['id' => self::KURGANASKAYA_OBLAST->value, 'name' => self::KURGANASKAYA_OBLAST->name, 'value' => 'Курганская область'],
            ['id' => self::KURSKAYA_OBLAST->value, 'name' => self::KURSKAYA_OBLAST->name, 'value' => 'Курская область'],
            ['id' => self::LENINGRADSKAYA_OBLAST->value, 'name' => self::LENINGRADSKAYA_OBLAST->name, 'value' => 'Ленинградская область'],
            ['id' => self::LIPECKAYA_OBLAST->value, 'name' => self::LIPECKAYA_OBLAST->name, 'value' => 'Липецкая область'],
            ['id' => self::MAGADANSKAYA_OBLAST->value, 'name' => self::MAGADANSKAYA_OBLAST->name, 'value' => 'Магаданская область'],
            ['id' => self::MOSKOVSKAYA_OBLAST->value, 'name' => self::MOSKOVSKAYA_OBLAST->name, 'value' => 'Московская область'],
            ['id' => self::MURMANSKAYA_OBLAST->value, 'name' => self::MURMANSKAYA_OBLAST->name, 'value' => 'Мурманская область'],
            ['id' => self::NIZHEGORODSKAYA_OBLAST->value, 'name' => self::NIZHEGORODSKAYA_OBLAST->name, 'value' => 'Нижегородская область'],
            ['id' => self::NOVGORODSKAYA_OBLAST->value, 'name' => self::NOVGORODSKAYA_OBLAST->name, 'value' => 'Новгородская область'],
            ['id' => self::NOVOSIBIRSKAYA_OBLAST->value, 'name' => self::NOVOSIBIRSKAYA_OBLAST->name, 'value' => 'Новосибирская область'],
            ['id' => self::OMSKAYA_OBLAST->value, 'name' => self::OMSKAYA_OBLAST->name, 'value' => 'Омская область'],
            ['id' => self::ORENBURSKAYA_OBLAST->value, 'name' => self::ORENBURSKAYA_OBLAST->name, 'value' => 'Оренбургская область'],
            ['id' => self::ORLOVSKAYA_OBLAST->value, 'name' => self::ORLOVSKAYA_OBLAST->name, 'value' => 'Орловская область'],
            ['id' => self::PENZENSKAYA_OBLAST->value, 'name' => self::PENZENSKAYA_OBLAST->name, 'value' => 'Пензенская область'],
            ['id' => self::PERMSKY_KRAI->value, 'name' => self::PERMSKY_KRAI->name, 'value' => 'Пермский край'],
            ['id' => self::PSKOVSKAYA_OBLAST->value, 'name' => self::PSKOVSKAYA_OBLAST->name, 'value' => 'Псковская область'],
            ['id' => self::ROSTOVSKAYA_OBLAST->value, 'name' => self::ROSTOVSKAYA_OBLAST->name, 'value' => 'Ростовская область'],
            ['id' => self::RYAZANSKAYA_OBLAST->value, 'name' => self::RYAZANSKAYA_OBLAST->name, 'value' => 'Рязанская область'],
            ['id' => self::SAMARSKAYA_OBLAST->value, 'name' => self::SAMARSKAYA_OBLAST->name, 'value' => 'Самарская область'],
            ['id' => self::SARATOVSKAYA_OBLAST->value, 'name' => self::SARATOVSKAYA_OBLAST->name, 'value' => 'Саратовская область'],
            ['id' => self::SAKHALINSKAYA_OBLAST->value, 'name' => self::SAKHALINSKAYA_OBLAST->name, 'value' => 'Сахалинская область'],
            ['id' => self::SVERDLOVSKAYA_OBLAST->value, 'name' => self::SVERDLOVSKAYA_OBLAST->name, 'value' => 'Свердловская область'],
            ['id' => self::SMOLENSKAYA_OBLAST->value, 'name' => self::SMOLENSKAYA_OBLAST->name, 'value' => 'Смоленская область'],
            ['id' => self::TAMBOVSKAYA_OBLAST->value, 'name' => self::TAMBOVSKAYA_OBLAST->name, 'value' => 'Тамбовская область'],
            ['id' => self::TVERSKAYA_OBLAST->value, 'name' => self::TVERSKAYA_OBLAST->name, 'value' => 'Тверская область'],
            ['id' => self::TOMSKAYA_OBLAST->value, 'name' => self::TOMSKAYA_OBLAST->name, 'value' => 'Томская область'],
            ['id' => self::TULSKAYA_OBLAST->value, 'name' => self::TULSKAYA_OBLAST->name, 'value' => 'Тульская область'],
            ['id' => self::TYUMENSKAYA_OBLAST->value, 'name' => self::TYUMENSKAYA_OBLAST->name, 'value' => 'Тюменская область'],
            ['id' => self::ULYANOVSKAYA_OBLAST->value, 'name' => self::ULYANOVSKAYA_OBLAST->name, 'value' => 'Ульяновская область'],
            ['id' => self::CHELYABINSKAYA_OBLAST->value, 'name' => self::CHELYABINSKAYA_OBLAST->name, 'value' => 'Челябинская область'],
            ['id' => self::ZABAIKALSKY_KRAI->value, 'name' => self::ZABAIKALSKY_KRAI->name, 'value' => 'Забайкальский край'],
            ['id' => self::YAROSLAVSKAYA_OBLAST->value, 'name' => self::YAROSLAVSKAYA_OBLAST->name, 'value' => 'Ярославская область'],
            ['id' => self::GOROD_MOSKVA->value, 'name' => self::GOROD_MOSKVA->name, 'value' => 'г. Москва'],
            ['id' => self::GOROD_SANKT_PETERBURG->value, 'name' => self::GOROD_SANKT_PETERBURG->name, 'value' => 'г. Санкт-Петербург'],
            ['id' => self::EVREISKAYA_AVTONOMNAYA_OBLAST->value, 'name' => self::EVREISKAYA_AVTONOMNAYA_OBLAST->name, 'value' => 'Еврейская автономная область'],
            ['id' => self::NENETSKY_AVTONOMNY_OKRUG->value, 'name' => self::NENETSKY_AVTONOMNY_OKRUG->name, 'value' => 'Ненецкий автономный округ'],
            ['id' => self::KHANTY_MANSIYSKY_AVTONOMNY_OKRUG_YUGRA->value, 'name' => self::KHANTY_MANSIYSKY_AVTONOMNY_OKRUG_YUGRA->name, 'value' => 'Ханты-Мансийский автономный округ - Югра'],
            ['id' => self::CHUKOTSKY_AVTONOMNY_OKRUG->value, 'name' => self::CHUKOTSKY_AVTONOMNY_OKRUG->name, 'value' => 'Чукотский автономный округ'],
            ['id' => self::YAMALO_NENETSKY_AVTONOMNY_OKRUG->value, 'name' => self::YAMALO_NENETSKY_AVTONOMNY_OKRUG->name, 'value' => 'Ямало-Ненецкий автономный округ'],
            ['id' => self::RESPUBLIKA_KRYM->value, 'name' => self::RESPUBLIKA_KRYM->name, 'value' => 'Республика Крым'],
            ['id' => self::GOROD_SEVASTOPOL->value, 'name' => self::GOROD_SEVASTOPOL->name, 'value' => 'г. Севастополь'],
            ['id' => self::DONYTSKAYA_NARODNAYA_RESPUBLIKA->value, 'name' => self::DONYTSKAYA_NARODNAYA_RESPUBLIKA->name, 'value' => 'Донецкая Народная Республика'],
            ['id' => self::LUHANSKAYA_NARODNAYA_RESPUBLIKA->value, 'name' => self::LUHANSKAYA_NARODNAYA_RESPUBLIKA->name, 'value' => 'Луганская Народная Республика'],
            ['id' => self::HERSONSKAYA_OBLAST->value, 'name' => self::HERSONSKAYA_OBLAST->name, 'value' => 'Херсонская область'],
            // ['id' => self::INYE_TERRITORII_I_KOSMODROM_BAIKONUR->value, 'name' => self::INYE_TERRITORII_I_KOSMODROM_BAIKONUR->name, 'value' => 'иные территории, включая город и космодром Байконур'],
        ];
    }
}
