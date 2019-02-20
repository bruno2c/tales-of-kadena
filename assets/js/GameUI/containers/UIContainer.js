import { connect } from 'react-redux'
import UI from "../components/UI"
import { changeOption, changeLevel } from '../actions/ui'

const mapStateToProps = (state, ownProps) => {
    return {
        currentLevel: state.ui.currentLevel,
        currentLevel1Action: state.ui.currentLevel1Action,
        currentLevel2Action: state.ui.currentLevel2Action,
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeOption: ({ currentLevel, currentLevel1Action, currentLevel2Action, direction }) => dispatch(changeOption({ currentLevel, currentLevel1Action, currentLevel2Action, direction })),
        changeLevel: (level) => dispatch(changeLevel(level)),
    }
}

const UIContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(UI)

export default UIContainer