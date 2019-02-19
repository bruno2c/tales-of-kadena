
export const setGeneralOption = (option) => ({
    type: 'SET_GENERAL_OPTION',
    option
})

export const lockGeneral = () => ({
    type: 'LOCK_GENERAL_OPTION'
})

export const unlockGeneral = () => ({
    type: 'UNLOCK_GENERAL_OPTION'
})

export const setBattleOption = (option) => ({
    type: 'SET_BATTLE_OPTION',
    option
})

export function changeOption(actual, direction) {
    return async dispatch => {
        let option =  '';

        if (direction === 'up') {

            if (actual === 'battle') {
                option = 'run';
            }

            if (actual === 'items') {
                option = 'battle';
            }

            if (actual === 'run') {
                option = 'items';
            }

        } else if (direction === 'down') {

            if (actual === 'battle') {
                option = 'items';
            }

            if (actual === 'items') {
                option = 'run';
            }

            if (actual === 'run') {
                option = 'battle';
            }

        }

        dispatch(setGeneralOption(option));
    }
}