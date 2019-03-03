import { connect } from 'react-redux'
import UI from "../components/UI"
import { changeOption, changeLevel } from '../actions/ui'
import { dispatchAction } from '../actions/arena';

const mapStateToProps = (state, ownProps) => {
    return {
        currentLevel: state.ui.currentLevel,
        currentSide: state.ui.currentSide,
        currentLevel1Action: state.ui.currentLevel1Action,
        currentLevel2Action: state.ui.currentLevel2Action,
        currentLevel3Action: state.ui.currentLevel3Action,
        currentLevel4Action: state.ui.currentLevel4Action,
        arena: state.arena
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeOption: (direction) => dispatch(changeOption(direction)),
        changeLevel: (level) => {

            if (level < 1) {
                level = 1;
            }

            if (level > 4) {
                dispatch(dispatchAction());

                return;
            }

            dispatch(changeLevel(level));
        },
    }
}

const UIContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(UI)

export default UIContainer