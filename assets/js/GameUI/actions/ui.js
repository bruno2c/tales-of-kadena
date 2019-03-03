import {
    UI_OPTION_DOWN,
    UI_OPTION_UP,
    UI_LEVEL_2_BATTLE,
    UI_LEVEL_2_ITEMS,
    UI_LEVEL_2_RUN,
    UI_LEVEL_3_BATTLE_ATTACK,
    UI_LEVEL_3_BATTLE_DEFENSE, UI_LEVEL_1_SLOT_1, UI_LEVEL_1_SLOT_2, UI_LEVEL_1_SLOT_3
} from '../constants/UIConstants'

export const changeLevel = (level) => {
    return {
        type: 'CHANGE_LEVEL',
        level
    }
}

export const changeLevel1Action = (action) => ({
    type: 'CHANGE_LEVEL_1_ACTION',
    action
})

export const changeLevel2Action = (action) => ({
    type: 'CHANGE_LEVEL_2_ACTION',
    action
})

export const changeLevel3Action = (action) => ({
    type: 'CHANGE_LEVEL_3_ACTION',
    action
})

export const changeLevel4Action = (action) => ({
    type: 'CHANGE_LEVEL_4_ACTION',
    action
})

export function changeOption(direction) {
    return async (dispatch, getState) => {
        let option =  '';
        let currentLevel = getState().ui.currentLevel;
        let currentLevel1Action = getState().ui.currentLevel1Action;
        let currentLevel2Action = getState().ui.currentLevel2Action;
        let currentLevel3Action = getState().ui.currentLevel3Action;
        let currentLevel4Action = getState().ui.currentLevel4Action;
        let qtyChampions = getState().ui.qtyChampions;
        let qtyEnemies = getState().ui.qtyEnemies;

        if (currentLevel === 1) {
            option = getCharacterSlotAction(currentLevel1Action, qtyChampions, direction);
            dispatch(changeLevel1Action(option));
        }

        if (currentLevel === 2) {

            if (direction === UI_OPTION_UP) {
                if (currentLevel2Action === UI_LEVEL_2_BATTLE) {
                    option = UI_LEVEL_2_RUN;
                }

                if (currentLevel2Action === UI_LEVEL_2_ITEMS) {
                    option = UI_LEVEL_2_BATTLE;
                }

                if (currentLevel2Action === UI_LEVEL_2_RUN) {
                    option = UI_LEVEL_2_ITEMS;
                }
            }

            if (direction === UI_OPTION_DOWN) {

                if (currentLevel2Action === UI_LEVEL_2_BATTLE) {
                    option = UI_LEVEL_2_ITEMS;
                }

                if (currentLevel2Action === UI_LEVEL_2_ITEMS) {
                    option = UI_LEVEL_2_RUN;
                }

                if (currentLevel2Action === UI_LEVEL_2_RUN) {
                    option = UI_LEVEL_2_BATTLE;
                }

            }

            dispatch(changeLevel2Action(option));
        }


        if (currentLevel === 3) {

            if (currentLevel3Action === UI_LEVEL_3_BATTLE_ATTACK) {
                option = UI_LEVEL_3_BATTLE_DEFENSE;
            }

            if (currentLevel3Action === UI_LEVEL_3_BATTLE_DEFENSE) {
                option = UI_LEVEL_3_BATTLE_ATTACK;
            }

            dispatch(changeLevel3Action(option));
        }

        if (currentLevel === 4) {
            option = getCharacterSlotAction(currentLevel4Action, qtyEnemies, direction);
            dispatch(changeLevel4Action(option));
        }
    }
}

function getCharacterSlotAction(currentSlot, qtySlots, direction) {

    if (qtySlots === 1) {
        return UI_LEVEL_1_SLOT_1;
    }

    if (qtySlots === 2) {

        if (currentSlot === UI_LEVEL_1_SLOT_1) {
            return UI_LEVEL_1_SLOT_2;
        }

        return UI_LEVEL_1_SLOT_1;
    }

    if (direction === UI_OPTION_UP) {

        if (currentSlot === UI_LEVEL_1_SLOT_1) {
            return UI_LEVEL_1_SLOT_3;
        }

        if (currentSlot === UI_LEVEL_1_SLOT_2) {
            return UI_LEVEL_1_SLOT_1;
        }

        if (currentSlot === UI_LEVEL_1_SLOT_3) {
            return UI_LEVEL_1_SLOT_2;
        }
    }

    if (direction === UI_OPTION_DOWN) {

        if (currentSlot === UI_LEVEL_1_SLOT_1) {
            return UI_LEVEL_1_SLOT_2;
        }

        if (currentSlot === UI_LEVEL_1_SLOT_2) {
            return UI_LEVEL_1_SLOT_3;
        }

        if (currentSlot === UI_LEVEL_1_SLOT_3) {
            return UI_LEVEL_1_SLOT_1;
        }
    }
}