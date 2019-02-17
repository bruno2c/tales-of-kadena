import { connect } from 'react-redux'
import Arena from '../components/Arena'

const mapStateToProps = (state, ownProps) => {
    return {}
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {}
}

const ArenaContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(Arena)

export default ArenaContainer