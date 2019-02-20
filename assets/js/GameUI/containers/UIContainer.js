import { connect } from 'react-redux'
import UI from "../components/UI"
import { changeOption, changeLevel } from '../actions/ui'

const mapStateToProps = (state, ownProps) => {
    return {
        currentLevel: state.ui.currentLevel,
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
        changeLevel: (level) => dispatch(changeLevel(level)),
    }
}

const UIContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(UI)

export default UIContainer