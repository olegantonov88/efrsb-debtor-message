<?php

namespace App\Enums\ParseJob;

enum ParseJobType: string
{
    case UpdateDebtorData = 'update_debtor_data';
    case FindDebtorUuid = 'find_debtor_uuid';
    case ProcessMessages = 'process_messages';
    case FetchMessageTables = 'fetch_message_tables';
    case DebtorMessages = 'debtor_messages';
    case MessageTables = 'message_tables';
}


