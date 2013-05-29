require 'spec_helper'

describe Project do
	describe '.followed_by!' do
		let(:project) { create(:project) }
		let(:user)    { create(:user) }

    before { project.followed_by!(user) }
  	
  	it { expect(project.reload.followers).to have(1).item }
  	it { expect(project.reload.users).to include(user) }

  	context 'when followed twice for the same user' do
  		before { project.followed_by!(user) }

  		it { expect(project.reload.followers).to have(1).item }
      it { expect(project.reload.users).to include(user) }
  	end
  end
end
