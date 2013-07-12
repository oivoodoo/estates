require 'spec_helper'

describe Project do
	describe '.followed_by!' do
		let(:project) { create(:project) }
		let(:user)    { create(:user) }

    before { project.followed_by!(user) }
  	
  	it { expect(project.reload.followers).to have(1).item }
  	it { expect(project.reload.users).to include(user) }

  	context '.unfollow!' do
  		before { project.unfollow!(user) }

  		it { expect(project.reload.followers).to have(0).item }
  	end
  end
end
